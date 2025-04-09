const express = require('express');
const mongoose = require('mongoose');
const bodyParser = require('body-parser');
const jwt = require('jsonwebtoken');
const bcrypt = require('bcryptjs');
const cors = require('cors');
const http = require('http');
const socketIo = require('socket.io');
const chalk = require('chalk');
const figlet = require('figlet');
require('dotenv').config();

// Inicializar la app y configurar middleware
const app = express();
const server = http.createServer(app);
// Configura Socket.IO para permitir conexiones desde cualquier origen (ajusta si es necesario para producción)
const io = socketIo(server, {
  cors: {
    origin: "*", // Permite cualquier origen. Considera restringirlo en producción.
    methods: ["GET", "POST"]
  }
});

app.use(cors()); // Asegúrate de que CORS esté habilitado para las rutas HTTP también
app.use(bodyParser.json());

// Validación de variables de entorno
if (!process.env.MONGODB_URI || !process.env.JWT_SECRET) {
  console.error(chalk.red('❌ Falta alguna variable de entorno. Asegúrate de tener MONGODB_URI y JWT_SECRET en el archivo .env'));
  process.exit(1); // Salir si faltan variables de entorno
}

// Conectar a MongoDB
mongoose.connect(process.env.MONGODB_URI)
  .then(() => {
    console.log(chalk.green('✅ Conectado a MongoDB'));
  })
  .catch((err) => {
    console.error(chalk.red('❌ Error al conectar a MongoDB:'), err.message);
  });

// Esquema de producto
const productSchema = new mongoose.Schema({
  name: String,
  price: Number,
  description: String,
  imageUrl: String
});
const Product = mongoose.model('Product', productSchema);

// Esquema de usuario
const userSchema = new mongoose.Schema({
  email: { type: String, required: true, unique: true },
  password: { type: String, required: true }
});
const User = mongoose.model('User', userSchema);

// Middleware de validación de datos
const validateProductData = (req, res, next) => {
  const { name, price, description, imageUrl } = req.body;
  // imageUrl es opcional ahora
  if (!name || typeof price !== 'number' || !description) {
    return res.status(400).send('Datos de producto incompletos o inválidos (nombre, precio numérico, descripción requeridos)');
  }
  next();
};

const validateUserData = (req, res, next) => {
  const { email, password } = req.body;
  if (!email || !password) {
    return res.status(400).send('Faltan email o contraseña');
  }
  next();
};

// Rutas de autenticación
app.post('/signup', validateUserData, async (req, res) => {
  const { email, password } = req.body;

  try {
    const userExists = await User.findOne({ email });
    if (userExists) return res.status(400).send('El email ya está en uso');

    const hashedPassword = await bcrypt.hash(password, 10);
    const user = new User({ email, password: hashedPassword });
    await user.save();
    res.status(201).send('Usuario creado');
  } catch (error) {
    console.error(chalk.yellow('⚠️ Error en /signup:'), error);
    res.status(500).send('Error al crear usuario: ' + error.message);
  }
});

app.post('/login', validateUserData, async (req, res) => {
  const { email, password } = req.body;

  try {
    const user = await User.findOne({ email });
    if (!user) return res.status(400).send('Usuario no encontrado');

    const isValidPassword = await bcrypt.compare(password, user.password);
    if (!isValidPassword) return res.status(400).send('Contraseña incorrecta');

    const token = jwt.sign({ userId: user._id }, process.env.JWT_SECRET, { expiresIn: '1h' });
    res.status(200).json({ token });
  } catch (error) {
    console.error(chalk.yellow('⚠️ Error en /login:'), error);
    res.status(500).send('Error al iniciar sesión: ' + error.message);
  }
});

// Middleware de autenticación
const authenticate = (req, res, next) => {
  const token = req.header('Authorization')?.replace('Bearer ', '');
  if (!token) return res.status(401).send('Acceso denegado. No se proporcionó token.');

  try {
    const decoded = jwt.verify(token, process.env.JWT_SECRET);
    req.userId = decoded.userId; // Adjunta el ID de usuario a la solicitud
    // Opcional: podrías buscar el usuario aquí si necesitas más datos del usuario en las rutas protegidas
    // req.user = await User.findById(decoded.userId);
    next();
  } catch (error) {
    if (error instanceof jwt.TokenExpiredError) {
        return res.status(401).send('Token expirado.');
    }
    if (error instanceof jwt.JsonWebTokenError) {
        return res.status(401).send('Token no válido.');
    }
    // Otros errores
    res.status(400).send('Error de autenticación.');
  }
};

// CRUD de productos
app.post('/products', authenticate, validateProductData, async (req, res) => {
  const { name, price, description, imageUrl } = req.body;

  const product = new Product({ name, price, description, imageUrl });
  try {
    const savedProduct = await product.save();
    io.emit('new-product', savedProduct); // Emitir el producto completo guardado
    res.status(201).json(savedProduct); // Devolver el producto creado
  } catch (error) {
    console.error(chalk.yellow('⚠️ Error en POST /products:'), error);
    res.status(400).send('Error al crear producto: ' + error.message);
  }
});

app.get('/products', authenticate, async (req, res) => {
  try {
    const products = await Product.find();
    res.status(200).json(products);
  } catch (error) {
    console.error(chalk.yellow('⚠️ Error en GET /products:'), error);
    res.status(500).send('Error al obtener productos: ' + error.message);
  }
});

app.delete('/products/:id', authenticate, async (req, res) => {
  const { id } = req.params;
  if (!mongoose.Types.ObjectId.isValid(id)) {
      return res.status(400).send('ID de producto inválido');
  }
  try {
    const deletedProduct = await Product.findByIdAndDelete(id);
    if (!deletedProduct) {
        return res.status(404).send('Producto no encontrado');
    }
    io.emit('delete-product', id); // Emitir el ID del producto eliminado
    res.status(200).send('Producto eliminado');
  } catch (error) {
    console.error(chalk.yellow(`⚠️ Error en DELETE /products/${id}:`), error);
    res.status(500).send('Error al eliminar producto: ' + error.message);
  }
});

app.put('/products/:id', authenticate, validateProductData, async (req, res) => {
  const { id } = req.params;
   if (!mongoose.Types.ObjectId.isValid(id)) {
      return res.status(400).send('ID de producto inválido');
  }
  const { name, price, description, imageUrl } = req.body;

  try {
    const updatedProduct = await Product.findByIdAndUpdate(
        id,
        { name, price, description, imageUrl },
        { new: true, runValidators: true } // Devuelve el documento actualizado y corre validaciones
    );
    if (!updatedProduct) {
        return res.status(404).send('Producto no encontrado para actualizar');
    }
    io.emit('update-product', updatedProduct); // Emitir el producto completo actualizado
    res.status(200).json(updatedProduct); // Devolver el producto actualizado
  } catch (error) {
    console.error(chalk.yellow(`⚠️ Error en PUT /products/${id}:`), error);
    res.status(400).send('Error al actualizar producto: ' + error.message);
  }
});

// --- RUTA RAÍZ CON HTML INTERACTIVO ---
app.get('/', (req, res) => {
  res.send(`
    <!DOCTYPE html>
    <html lang="es">
    <head>
      <meta charset="UTF-8">
      <title>TechSolutions API Dashboard</title>
      <style>
        body {
          font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
          background: #f4f4f4;
          color: #333;
          margin: 0;
          padding: 0;
          display: flex;
          justify-content: center;
          align-items: flex-start; /* Alinea arriba */
          min-height: 100vh; /* Asegura altura completa */
          padding-top: 40px; /* Espacio superior */
        }
        .container {
          max-width: 800px;
          width: 90%;
          background: white;
          padding: 30px;
          box-shadow: 0 2px 15px rgba(0,0,0,0.1);
          border-radius: 10px;
          text-align: center;
        }
        h1 {
          color: #007bff;
          margin-bottom: 10px;
        }
        h3 {
          color: #555;
          border-bottom: 1px solid #eee;
          padding-bottom: 8px;
          margin-top: 25px;
        }
        p {
          font-size: 16px;
          line-height: 1.6;
        }
        .endpoints-list {
          list-style: none;
          padding: 0;
          margin-top: 15px;
          text-align: left;
        }
        .endpoints-list li {
          background: #e9ecef;
          padding: 12px 15px;
          border-radius: 5px;
          margin: 8px 0;
          font-family: monospace;
          font-size: 14px;
          display: flex;
          justify-content: space-between;
          align-items: center;
        }
        .endpoints-list .method {
          font-weight: bold;
          color: #fff;
          padding: 3px 8px;
          border-radius: 3px;
          min-width: 60px; /* Ancho mínimo para alinear */
          text-align: center;
        }
        .method-post { background-color: #28a745; } /* Verde */
        .method-get { background-color: #007bff; } /* Azul */
        .method-put { background-color: #ffc107; color: #333; } /* Amarillo */
        .method-delete { background-color: #dc3545; } /* Rojo */

        #status {
          margin-top: 20px;
          font-weight: bold;
        }
        .status-connected { color: green; }
        .status-disconnected { color: red; }

        #realtime-log {
          margin-top: 20px;
          background: #222;
          color: #eee;
          padding: 15px;
          border-radius: 5px;
          text-align: left;
          font-family: monospace;
          font-size: 13px;
          height: 200px; /* Altura fija */
          overflow-y: auto; /* Scroll vertical */
          line-height: 1.5;
        }
        #realtime-log div {
          border-bottom: 1px dotted #444;
          padding: 4px 0;
        }
         #realtime-log div:last-child {
          border-bottom: none;
        }
        .log-new { color: #28a745; } /* Verde */
        .log-update { color: #ffc107; } /* Amarillo */
        .log-delete { color: #dc3545; } /* Rojo */
        .log-info { color: #17a2b8; } /* Cian */
        .log-error { color: #ff6b6b; } /* Rojo claro */

        footer {
          margin-top: 30px;
          font-size: 14px;
          color: #777;
        }
      </style>
      <script src="/socket.io/socket.io.js"></script>
    </head>
    <body>
      <div class="container">
        <h1>🚀 TechSolutions API Dashboard</h1>
        <p>Bienvenido al panel de la API RESTful de TechSolutions Innovations.</p>
        <p>Aquí puedes ver los endpoints disponibles y eventos en tiempo real.</p>

        <div id="status" class="status-disconnected">Desconectado del servidor WebSocket</div>

        <h3>📡 Log de Eventos en Tiempo Real:</h3>
        <div id="realtime-log">
            <div>Esperando eventos del servidor...</div>
        </div>

        <h3>📌 Endpoints Disponibles:</h3>
        <ul class="endpoints-list">
          <li><span class="method method-post">POST</span> <span>/signup</span></li>
          <li><span class="method method-post">POST</span> <span>/login</span></li>
          <li><span class="method method-get">GET</span> <span>/products</span></li>
          <li><span class="method method-post">POST</span> <span>/products</span></li>
          <li><span class="method method-put">PUT</span> <span>/products/:id</span></li>
          <li><span class="method method-delete">DELETE</span> <span>/products/:id</span></li>
        </ul>

        <footer>
          <p><em>Desarrollado con ❤️ por el equipo TechSolutions</em></p>
        </footer>
      </div>

      <script>
        const statusDiv = document.getElementById('status');
        const logDiv = document.getElementById('realtime-log');
        const MAX_LOG_LINES = 50; // Limitar el número de líneas en el log

        // Intenta conectar al servidor WebSocket (asume que está en el mismo host/puerto)
        const socket = io();

        function addLogMessage(message, type = 'info') {
            const entry = document.createElement('div');
            entry.textContent = \`[\${new Date().toLocaleTimeString()}] \${message}\`;
            entry.classList.add(\`log-\${type}\`);

            // Inserta el nuevo mensaje al principio
            logDiv.insertBefore(entry, logDiv.firstChild);

             // Limpiar el mensaje inicial si es necesario
            if (logDiv.childElementCount > 1 && logDiv.lastChild.textContent.includes('Esperando eventos')) {
                 logDiv.removeChild(logDiv.lastChild);
            }

            // Limitar el número de líneas en el log
            while (logDiv.childElementCount > MAX_LOG_LINES) {
                logDiv.removeChild(logDiv.lastChild); // Elimina el mensaje más antiguo
            }
        }

        socket.on('connect', () => {
          console.log('Conectado al servidor WebSocket:', socket.id);
          statusDiv.textContent = 'Conectado al servidor WebSocket';
          statusDiv.className = 'status-connected';
          addLogMessage('Conexión WebSocket establecida.', 'info');
        });

        socket.on('disconnect', (reason) => {
          console.log('Desconectado del servidor WebSocket:', reason);
          statusDiv.textContent = 'Desconectado del servidor WebSocket';
          statusDiv.className = 'status-disconnected';
           addLogMessage(\`Desconexión WebSocket: \${reason}\`, 'error');
        });

        socket.on('connect_error', (error) => {
            console.error('Error de conexión WebSocket:', error);
            statusDiv.textContent = 'Error al conectar WebSocket';
            statusDiv.className = 'status-disconnected';
            addLogMessage(\`Error de conexión: \${error.message}\`, 'error');
        });

        // Escuchar eventos de productos emitidos por el servidor
        socket.on('new-product', (product) => {
          console.log('Nuevo producto recibido:', product);
          addLogMessage(\`Nuevo Producto: \${product.name} (ID: \${product._id})\`, 'new');
        });

        socket.on('update-product', (product) => {
          console.log('Producto actualizado recibido:', product);
          addLogMessage(\`Producto Actualizado: \${product.name} (ID: \${product._id})\`, 'update');
        });

        socket.on('delete-product', (productId) => {
          console.log('Producto eliminado recibido:', productId);
          addLogMessage(\`Producto Eliminado: ID \${productId}\`, 'delete');
        });

        // Limpiar el mensaje inicial si la conexión se establece rápido
        if (logDiv.textContent.includes('Esperando eventos')) {
             // Puede que no sea necesario si la conexión es instantánea, pero es una precaución
        }

      </script>
    </body>
    </html>
  `);
});
// --- FIN DE LA RUTA RAÍZ ---

// Middleware para manejo de errores (al final de todas las rutas y middlewares)
app.use((err, req, res, next) => {
  console.error(chalk.red('❌ Error no manejado:'), err.stack); // Mejor log de error
  // Evitar enviar detalles del error en producción por seguridad
  const errorMessage = process.env.NODE_ENV === 'production'
    ? 'Ocurrió un error interno en el servidor.'
    : `Error interno del servidor: ${err.message}`;
  res.status(err.status || 500).send(errorMessage);
});

// WebSocket - Ya está configurado arriba con CORS
io.on('connection', (socket) => {
  console.log(chalk.blue('🔌 Nuevo cliente conectado vía WebSocket:', socket.id));

  socket.on('disconnect', (reason) => {
    console.log(chalk.yellow('🚪 Cliente desconectado:', socket.id, 'Razón:', reason));
  });

  // Puedes añadir listeners para eventos específicos del cliente aquí si es necesario
  // socket.on('custom-event', (data) => { ... });
});

// Iniciar servidor
const port = process.env.PORT || 3000;
server.listen(port, () => {
  console.clear();
  console.log(
    chalk.cyan(
      figlet.textSync('TechSolutions', { horizontalLayout: 'full' })
    )
  );

  console.log(chalk.green.bold('🚀 Servidor iniciado con éxito!'));
  console.log(chalk.yellow('🔗 URL: ') + chalk.whiteBright(`http://localhost:${port}`));
  console.log(chalk.magenta('✨ Endpoints Principales: ') + chalk.cyanBright('/products, /signup, /login'));
  console.log(chalk.blue('💾 Base de datos: ') + chalk.whiteBright(process.env.MONGODB_URI ? 'MongoDB Conectada' : 'MongoDB URI no configurada'));
  console.log(chalk.gray('🔐 Seguridad: JWT habilitado'));
  console.log(chalk.gray('📡 Real-time: WebSocket activo\n'));
});

// Manejo de cierre inesperado
process.on('SIGINT', () => {
    console.log(chalk.red('\n🚨 Servidor detenido. Cerrando conexiones...'));
    mongoose.connection.close(() => {
        console.log(chalk.gray(' MongoDB desconectado.'));
        server.close(() => {
             console.log(chalk.gray(' Servidor HTTP cerrado.'));
             process.exit(0);
        });
    });
});