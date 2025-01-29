<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Soporte al Usuario - TechSolutions Innovations</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
            font-family: 'Open Sans', sans-serif;
            background-color: #f8f9fa;
        }
        .support-section {
            margin-bottom: 20px;
        }
        .support-section h3 {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border-radius: 5px;
        }
        .support-section ul {
            list-style: none;
            padding: 0;
        }
        .support-section ul li {
            background-color: #ffffff;
            margin: 5px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .support-section ul li:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Soporte al Usuario</h1>
        <div class="support-section">
            <h3>Preguntas Frecuentes</h3>
            <ul>
                <li><a href="faq.php">¿Cómo puedo crear una cuenta?</a></li>
                <li><a href="faq.php">¿Cómo puedo restablecer mi contraseña?</a></li>
                <li><a href="faq.php">¿Cómo puedo contactar al soporte técnico?</a></li>
                <li><a href="faq.php">¿Dónde puedo encontrar información sobre los productos?</a></li>
            </ul>
        </div>
        <div class="support-section">
            <h3>Contacto Directo</h3>
            <p>Si no encuentras respuesta a tu pregunta, puedes contactarnos directamente a través de los siguientes medios:</p>
            <ul>
                <li>Email: <a href="mailto:soporte@techsolutions.com">soporte@techsolutions.com</a></li>
                <li>Teléfono: +1 800 123 4567</li>
                <li><a href="contact.php">Formulario de Contacto</a></li>
            </ul>
        </div>
        <div class="support-section">
            <h3>Chat en Vivo</h3>
            <p>Para soporte inmediato, utiliza nuestro <a href="chat.php">chat en vivo</a> para hablar con un representante.</p>
        </div>
        <div class="support-section">
            <h3>Tutoriales y Guías</h3>
            <p>Consulta nuestras guías y tutoriales para obtener ayuda paso a paso sobre el uso de nuestros productos y servicios:</p>
            <ul>
                <li><a href="guide1.php">Guía de Inicio Rápido</a></li>
                <li><a href="guide2.php">Cómo Utilizar Nuestro Servicio</a></li>
                <li><a href="guide3.php">Solución de Problemas Comunes</a></li>
            </ul>
        </div>
        <button id="back-button" class="btn btn-primary mt-3">Volver</button>
    </div>

    <script>
        document.getElementById('back-button').addEventListener('click', () => {
            window.history.back();
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
