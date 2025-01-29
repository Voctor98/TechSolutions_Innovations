<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Preguntas Frecuentes (FAQ) - TechSolutions Innovations</title>
    <link rel="icon" href="images/favicon.png" type="image/png">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Open Sans', sans-serif;
            color: #333;
            background: #f8f9fa;
        }
        .background-image {
            background-image: url('images/jean-philippe-delberghe-75xPHEQBmvA-unsplash.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: -1;
            opacity: 0.7;
        }
        .content {
            position: relative;
            z-index: 1;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .faq-section {
            margin: 20px 0;
        }
        .faq-question {
            font-weight: bold;
            margin-bottom: 10px;
        }
        .faq-answer {
            margin-bottom: 20px;
        }
        .card {
            background: rgba(255, 255, 255, 0.8);
        }
        .card:hover {
            transform: scale(1.05);
            transition: transform 0.3s;
        }
        .navbar-brand, .nav-link {
            color: #333 !important;
        }
        .alert {
            background: rgba(255, 255, 255, 0.8);
            color: #333;
        }
        .logo {
            max-width: 100px;
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
                <li class="nav-item">
                    <a class="nav-link" href="sitemap.html">Mapa del Sitio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="faq.php">FAQ</a>
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
    <div class="container my-5 content">
        <h1 class="text-center">Preguntas Frecuentes (FAQ)</h1>
        <div class="faq-section">
            <div class="faq-question">1. ¿Qué servicios ofrece TechSolutions Innovations?</div>
            <div class="faq-answer">Ofrecemos una variedad de servicios incluyendo consultoría tecnológica, desarrollo de software y soporte técnico.</div>
        </div>
        <div class="faq-section">
            <div class="faq-question">2. ¿Cómo puedo contactar con TechSolutions Innovations?</div>
            <div class="faq-answer">Puedes contactarnos a través de nuestro formulario de contacto en la página de contacto, o llamarnos al +52 449 183 0065.</div>
        </div>
        <div class="faq-section">
            <div class="faq-question">3. ¿Qué productos vende TechSolutions Innovations?</div>
            <div class="faq-answer">Vendemos una variedad de productos tecnológicos como laptops, smartphones y accesorios de computación.</div>
        </div>
        <div class="faq-section">
            <div class="faq-question">4. ¿Dónde está ubicada TechSolutions Innovations?</div>
            <div class="faq-answer">Nuestra oficina principal está ubicada en Blvd. Juan Pablo II No. 1302 Ex hacienda la Cantera, 20200 Aguascalientes, Ags.</div>
        </div>
        <div class="faq-section">
            <div class="faq-question">5. ¿TechSolutions Innovations ofrece soporte técnico?</div>
            <div class="faq-answer">Sí, ofrecemos soporte técnico para asegurar que tus sistemas funcionen sin problemas.</div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrap.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
    </script>

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
