const express = require('express');
const mongoose = require('mongoose');
const bodyParser = require('body-parser');
const jwt = require('jsonwebtoken');
const bcrypt = require('bcryptjs');
const cors = require('cors');
const http = require('http');
const socketIo = require('socket.io');
require('dotenv').config();

// Inicializar la app y configurar middleware
const app = express();
const server = http.createServer(app);
const io = socketIo(server); // Configuración de WebSocket

app.use(cors());  // Permitir solicitudes desde otros orígenes
app.use(bodyParser.json());  // Parsear JSON en las solicitudes

// Conectar a MongoDB
mongoose.connect(process.env.MONGODB_URI)
  .then(() => console.log('Conectado a MongoDB'))
  .catch((err) => console.error('Error al conectar a MongoDB:', err));

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

// Ruta de autenticación de usuario
app.post('/signup', async (req, res) => {
  const { email, password } = req.body;
  const hashedPassword = await bcrypt.hash(password, 10);

  const user = new User({ email, password: hashedPassword });
  try {
    await user.save();
    res.status(201).send('Usuario creado');
  } catch (error) {
    res.status(400).send('Error al crear usuario: ' + error.message);
  }
});

app.post('/login', async (req, res) => {
  const { email, password } = req.body;
  const user = await User.findOne({ email });

  if (!user) return res.status(400).send('Usuario no encontrado');

  const isValidPassword = await bcrypt.compare(password, user.password);
  if (!isValidPassword) return res.status(400).send('Contraseña incorrecta');

  const token = jwt.sign({ userId: user._id }, process.env.JWT_SECRET, { expiresIn: '1h' });
  res.status(200).json({ token });
});

// Middleware de autenticación con JWT
const authenticate = (req, res, next) => {
  const token = req.header('Authorization')?.replace('Bearer ', '');

  if (!token) return res.status(401).send('No autorizado');

  try {
    const decoded = jwt.verify(token, process.env.JWT_SECRET);
    req.userId = decoded.userId;
    next();
  } catch (error) {
    res.status(401).send('Token no válido');
  }
};

// CRUD para productos

// Crear un producto
app.post('/products', authenticate, async (req, res) => {
  const { name, price, description, imageUrl } = req.body;

  const product = new Product({ name, price, description, imageUrl });
  try {
    await product.save();
    // Emitir evento para notificar a todos los clientes conectados
    io.emit('new-product', product); // Enviar el nuevo producto a todos los clientes conectados
    res.status(201).send('Producto creado');
  } catch (error) {
    res.status(400).send('Error al crear producto: ' + error.message);
  }
});

// Obtener todos los productos
app.get('/products', authenticate, async (req, res) => {
  try {
    const products = await Product.find();
    res.status(200).json(products);
  } catch (error) {
    res.status(400).send('Error al obtener productos: ' + error.message);
  }
});

// Eliminar un producto
app.delete('/products/:id', authenticate, async (req, res) => {
  const { id } = req.params;
  try {
    await Product.findByIdAndDelete(id);
    // Emitir evento de eliminación a todos los clientes
    io.emit('delete-product', id); // Eliminar producto en todos los clientes
    res.status(200).send('Producto eliminado');
  } catch (error) {
    res.status(400).send('Error al eliminar producto: ' + error.message);
  }
});

// Actualizar un producto
app.put('/products/:id', authenticate, async (req, res) => {
  const { id } = req.params;
  const { name, price, description, imageUrl } = req.body;

  try {
    await Product.findByIdAndUpdate(id, { name, price, description, imageUrl });
    // Emitir evento de actualización a todos los clientes
    io.emit('update-product', { id, name, price, description, imageUrl });
    res.status(200).send('Producto actualizado');
  } catch (error) {
    res.status(400).send('Error al actualizar producto: ' + error.message);
  }
});

// Ruta raíz
app.get('/', (req, res) => {
  res.send('Bienvenido a la API de TechSolutions');
});

// Conectar a WebSocket
io.on('connection', (socket) => {
  console.log('Nuevo cliente conectado');

  // Manejar la desconexión
  socket.on('disconnect', () => {
    console.log('Cliente desconectado');
  });
});

// Iniciar el servidor
const port = process.env.PORT || 3000;
server.listen(port, () => {
  console.log(`Servidor corriendo en http://localhost:${port}`);
});
