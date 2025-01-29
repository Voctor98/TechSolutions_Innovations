<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto - TechSolutions Innovations</title>
    <link rel="icon" href="images/favicon.png" type="image/png">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <style>
        .card:hover {
            transform: scale(1.05);
            transition: transform 0.3s;
        }
        .logo {
            max-width: 100px;
            margin-right: 10px;
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
            opacity: 0.9;
        }
        .content {
            position: relative;
            z-index: 1;
            padding: 20px;
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
        .contact-info {
            background: #f8f9fa;
            padding: 50px 20px;
        }
        .contact-form {
            padding: 50px 20px;
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
        <h1>Contacto</h1>
        <p>Estamos aquí para ayudarte. Ponte en contacto con nosotros para cualquier consulta.</p>
    </div>
    <section id="contact-info" class="contact-info">
        <div class="container">
            <h2 class="text-center mb-4">Ponte en Contacto con Nosotros</h2>
            <p class="text-center">Si tienes alguna pregunta o necesitas más información, no dudes en ponerte en contacto con nosotros a través del siguiente formulario o visitándonos en nuestra ubicación.</p>
            <div class="row mt-5">
                <div class="col-md-6">
                    <h3>Información de Contacto</h3>
                    <p><strong>Dirección:</strong> Blvd. Juan Pablo II No. 1302 Ex hacienda la Cantera, 20200 Aguascalientes, Ags.</p>
                    <p><strong>Teléfono:</strong> +52 449 183 0065</p>
                    <p><strong>Email:</strong> info@techsolutions.com</p>
                    <h3>Síguenos en las Redes Sociales</h3>
                    <div class="d-flex justify-content-start mt-3">
                        <a href="https://www.facebook.com/voctor7u7" target="_blank" class="mx-2">
                            <img src="images/facebook.png" alt="Facebook" width="32" height="32">
                        </a>
                        <a href="https://twitter.com/VctorMe90449678" target="_blank" class="mx-2">
                            <img src="images/twitter.png" alt="Twitter" width="32" height="32">
                        </a>
                        <a href="https://www.instagram.com/victor.mendozap/" target="_blank" class="mx-2">
                            <img src="images/instagram.png" alt="Instagram" width="32" height="32">
                        </a>
                        <a href="https://www.linkedin.com/in/v%C3%ADctor-mendoza-b23b80315/" target="_blank" class="mx-2">
                            <img src="images/linkedin.png" alt="LinkedIn" width="32" height="32">
                        </a>
                    </div>
                </div>
                <div class="col-md-6 contact-form">
                    <h3>Envíanos un Mensaje</h3>
                    <form id="contact-form" class="needs-validation" novalidate>
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" id="name" name="user_name" class="form-control" required>
                            <div class="invalid-feedback">Por favor, ingresa tu nombre.</div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="user_email" class="form-control" required>
                            <div class="invalid-feedback">Por favor, ingresa tu email.</div>
                        </div>
                        <div class="form-group">
                            <label for="message">Mensaje:</label>
                            <textarea id="message" name="message" class="form-control" rows="5" required></textarea>
                            <div class="invalid-feedback">Por favor, ingresa tu mensaje.</div>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Enviar Mensaje</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrap.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.emailjs.com/dist/email.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
    (function() {
        'use strict';
        emailjs.init('CmcW5DX-iqKOIvhys'); // Reemplaza 'YOUR_PUBLIC_KEY' con tu clave pública

        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    } else {
                        event.preventDefault();
                        emailjs.sendForm('service_39jrzfh', 'template_i98agua', form)
                            .then(function() {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Mensaje enviado',
                                    text: 'Tu mensaje ha sido enviado exitosamente.'
                                });
                            }, function(error) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Ocurrió un error al enviar tu mensaje. Por favor, inténtalo nuevamente.'
                                });
                            });
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
    </script>
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
