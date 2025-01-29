<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Servicios - TechSolutions Innovations</title>
    <link rel="icon" href="images/favicon.png" type="image/png">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Open Sans', sans-serif;
            color: #333; /* Color oscuro para el texto */
        }
        .background-image {
            background-image: url('images/jean-philippe-delberghe-75xPHEQBmvA-unsplash.jpg'); /* Ruta de la imagen de fondo */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.9; /* Ajusta la opacidad si es necesario */
        }
        .content {
            position: relative;
            z-index: 1;
            padding: 20px;
            background: rgba(255, 255, 255, 0.8); /* Fondo semi-transparente */
            border-radius: 10px;
        }
        .card:hover {
            transform: scale(1.05);
            transition: transform 0.3s;
        }
        .navbar-brand, .nav-link {
            color: #333 !important; /* Color oscuro para los elementos de navegación */
        }
        .hero-section {
            background: rgba(0, 0, 0, 0.5); /* Fondo semi-transparente oscuro */
            color: #fff;
            text-align: center;
            padding: 100px 20px;
        }
        .hero-section h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }
        .hero-section p {
            font-size: 1.25rem;
        }
        footer {
            background-color: #f8f9fa;
            padding: 10px 20px;
        }
        .footer-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            text-align: center;
        }
        .footer-content div {
            flex: 1;
            margin: 5px 0;
        }
        .footer-links a, .social-links a, .contact a {
            display: block;
            color: #007bff;
            text-decoration: none;
            margin: 2px 0;
        }
    </style>
</head>
<body>
    <!-- Menú de Navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">TechSolutions Innovations</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="services.php">Servicios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="products.php">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contacto</a>
                </li>
                <?php if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Cerrar Sesión</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Iniciar Sesión</a>
                    </li>
                <?php endif; ?>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="search.php" method="GET">
                <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Buscar" name="query">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
            </form>
        </div>
    </nav>
    <!-- Fin del Menú de Navegación -->

    <div class="background-image"></div>
    <div class="hero-section">
        <h1>Servicios</h1>
        <p>Descubre nuestros servicios tecnológicos de vanguardia</p>
    </div>
    <section id="services" class="container my-5 content">
        <h2 class="text-center">Nuestros Servicios</h2>
        <p class="text-center">La página es exclusivamente informativa para aquellos usuarios que necesiten conocer los productos.</p>
    </section>
    <section id="product-presentation" class="container my-5 content">
        <h2 class="text-center">Presentación de Productos</h2>
        <div class="row mt-5">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Catálogo de Productos</h3>
                        <p class="card-text">Mostrar una lista de productos electrónicos y de computación con descripciones detalladas, imágenes y precios.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Búsqueda y Filtros</h3>
                        <p class="card-text">Funcionalidades para buscar productos y filtrar por categoría, precio, marca, etc.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Comparación de Productos</h3>
                        <p class="card-text">Permitir a los usuarios comparar características y precios de diferentes productos.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrap.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

 <!-- Footer -->
 <footer>
        <div class="footer-content">
            <div class="brand">
                <p>TechSolutionsInnovations</p>
            </div>
            <div class="social-links">
                <a href="https://www.facebook.com" target="_blank">Facebook</a>
                <a href="https://www.twitter.com" target="_blank">Twitter</a>
                <a href="https://www.instagram.com" target="_blank">Instagram</a>
            </div>
            <div class="footer-links">
                <a href="support.php">Soporte al usuario</a>
                <a href="faq.php">Preguntas frecuentes</a>
                <a href="about.php">Acerca de</a>
                <a href="terms.php">Términos y condiciones</a>
            </div>
            <div class="company-info">
                <p>Dirección de la empresa</p>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2202.1106761658757!2d-102.35332368917338!3d21.83847508176745!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8429eb8c66ba4c57%3A0x800a85fa04315af2!2sUniversidad%20Tecnol%C3%B3gica%20de%20Aguascalientes!5e0!3m2!1ses-419!2smx!4v1720334252646!5m2!1ses-419!2smx" width="200" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="sitemap">
                <a href="sitemap.html">Mapa del sitio</a>
            </div>
            <div class="contact">
                <p>Buzón: <a href="mailto:info@empresa.com">info@empresa.com</a></p>
                <a href="chat.php">Chat en vivo</a>
            </div>
        </div>
    </footer>
</body>
</html>
