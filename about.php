<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nosotros - TechSolutions Innovations</title>
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
        }
        .card:hover {
            transform: scale(1.05);
            transition: transform 0.3s;
        }
        .navbar-brand, .nav-link {
            color: #333 !important; /* Color oscuro para los elementos de navegación */
        }
        .alert {
            background: rgba(255, 255, 255, 0.8); /* Fondo semi-transparente claro */
            color: #333; /* Color oscuro para el texto de la alerta */
        }
        .logo {
            max-width: 100px; /* Ajusta el tamaño del logotipo según sea necesario */
            margin-right: 10px;
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
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('images/hero-bg.jpg');
            background-size: cover;
            background-position: center;
            padding: 100px 20px;
            color: #fff;
            text-align: center;
        }
        .hero-section h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }
        .hero-section p {
            font-size: 1.25rem;
        }
        .team-section {
            background: #f8f9fa;
            padding: 50px 20px;
        }
        .team-member {
            text-align: center;
            margin-bottom: 30px;
        }
        .team-member img {
            border-radius: 50%;
            max-width: 150px;
            margin-bottom: 15px;
        }
        .values-section, .vision-section {
            padding: 50px 20px;
        }
        .values-section ul {
            list-style: none;
            padding: 0;
        }
        .values-section ul li {
            background: #007bff;
            color: #fff;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
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
        <h1>Conoce a TechSolutions Innovations</h1>
        <p>Innovando el futuro con soluciones tecnológicas de vanguardia</p>
    </div>
    <section id="about" class="container my-5 content">
        <h2 class="text-center">Quiénes Somos</h2>
        <p class="text-center">En TechSolutions Innovations, nos dedicamos a ofrecer soluciones tecnológicas de vanguardia para satisfacer las necesidades de nuestros clientes. Desde nuestra fundación, nos hemos comprometido a proporcionar productos de alta calidad y un servicio excepcional.</p>
        <div class="row mt-5">
            <div class="col-md-6">
                <h3>Nuestra Historia</h3>
                <p>TechSolutions Innovations fue fundada en 2010 con la misión de brindar soluciones tecnológicas innovadoras. A lo largo de los años, hemos crecido y nos hemos adaptado a los cambios del mercado, siempre con el objetivo de mantenernos a la vanguardia de la tecnología.</p>
            </div>
            <div class="col-md-6">
                <h3>El Equipo</h3>
                <p>Contamos con un equipo de profesionales apasionados y dedicados a ofrecer el mejor servicio. Nuestro equipo está compuesto por expertos en diversas áreas de la tecnología, lo que nos permite abordar una amplia gama de necesidades y proyectos.</p>
            </div>
        </div>
    </section>
    <section class="values-section">
        <div class="container">
            <h2 class="text-center">Nuestros Valores</h2>
            <ul>
                <li>Innovación: Nos esforzamos por estar siempre a la vanguardia de la tecnología.</li>
                <li>Calidad: Nos comprometemos a ofrecer productos y servicios de la más alta calidad.</li>
                <li>Servicio: La satisfacción del cliente es nuestra prioridad número uno.</li>
            </ul>
        </div>
    </section>
    <section class="vision-section">
        <div class="container">
            <h2 class="text-center">Nuestra Visión</h2>
            <p class="text-center">Nuestra visión es ser líderes en el mercado de soluciones tecnológicas, reconocidos por nuestra innovación, calidad y servicio al cliente. Queremos ser el socio de confianza de nuestros clientes en su camino hacia el éxito tecnológico.</p>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
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
</html>