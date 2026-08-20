<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soporte al Usuario - TechSolutions Innovations</title>
    <link rel="icon" href="images/favicon.png" type="image/png">
    <link rel="stylesheet" href="style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(135deg, rgba(0, 98, 230, 0.85), rgba(51, 174, 255, 0.85)), url('images/hero-bg.jpg');
            background-size: cover;
            background-position: center;
            padding: 80px 20px 100px 20px;
            color: #fff;
            text-align: center;
        }
        .hero-section h1 {
            font-weight: 600;
            font-size: 2.5rem;
            margin-bottom: 15px;
            letter-spacing: -0.5px;
        }
        .support-content-wrapper {
            margin-top: -60px;
            position: relative;
            z-index: 10;
            padding-bottom: 50px;
        }
        .support-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.03), 0 1px 3px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: #ffffff;
        }
        .support-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.08);
        }
        .support-card h3 {
            color: var(--primary-blue, #0062E6);
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 15px;
            border-bottom: 2px solid #f1f3f5;
            padding-bottom: 10px;
        }
        .support-card ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .support-card ul li {
            padding: 8px 0;
            border-bottom: 1px solid #f8f9fa;
        }
        .support-card ul li:last-child {
            border-bottom: none;
        }
        .support-card ul li a {
            color: #495057;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .support-card ul li a:hover {
            color: var(--primary-blue, #0062E6);
            text-decoration: none;
        }
        .footer-map iframe {
            border-radius: 8px;
            width: 100%;
            height: 150px;
        }
        .footer-links-list a, .footer-contact-list a {
            color: #a8b2bc;
            text-decoration: none;
            display: block;
            margin-bottom: 8px;
            transition: color 0.3s ease;
        }
        .footer-links-list a:hover, .footer-contact-list a:hover {
            color: #ffffff;
        }
    </style>
</head>
<body>
    <!-- Header unificado -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-transparent p-0">
            <a class="navbar-brand font-weight-bold" href="index.php">TechSolutions Innovations</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="services.php">Servicios</a></li>
                    <li class="nav-item"><a class="nav-link" href="products.php">Productos</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">Nosotros</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contacto</a></li>
                    <?php if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin'): ?>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Cerrar Sesión</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="login.php">Iniciar Sesión</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <div class="hero-section">
            <div class="container">
                <h1>Soporte al Usuario</h1>
                <p>Encuentra respuestas rápidas, guías o comunícate directamente con nuestro equipo.</p>
            </div>
        </div>

        <div class="container support-content-wrapper">
            <div class="row">
                <!-- Preguntas Frecuentes -->
                <div class="col-md-6">
                    <div class="card support-card p-4">
                        <h3>Preguntas Frecuentes</h3>
                        <ul>
                            <li>👉 <a href="faq.php">¿Cómo puedo crear una cuenta?</a></li>
                            <li>👉 <a href="faq.php">¿Cómo puedo restablecer mi contraseña?</a></li>
                            <li>👉 <a href="faq.php">¿Cómo puedo contactar al soporte técnico?</a></li>
                            <li>👉 <a href="faq.php">¿Dónde puedo encontrar información sobre los productos?</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Contacto Directo -->
                <div class="col-md-6">
                    <div class="card support-card p-4">
                        <h3>Contacto Directo</h3>
                        <p class="text-muted small">Si no encuentras respuesta, contáctanos mediante:</p>
                        <ul>
                            <li>📧 Email: <a href="mailto:soporte@techsolutions.com">soporte@techsolutions.com</a></li>
                            <li>📞 Teléfono: +1 800 123 4567</li>
                            <li>📝 <a href="contact.php">Ir al Formulario de Contacto</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Chat en Vivo -->
                <div class="col-md-6">
                    <div class="card support-card p-4">
                        <h3>Chat en Vivo</h3>
                        <p class="text-muted mb-0">Para soporte inmediato y asistencia en tiempo real, utiliza nuestro <a href="chat.php" class="font-weight-bold text-primary">chat en vivo</a>.</p>
                    </div>
                </div>

                <!-- Tutoriales y Guías -->
                <div class="col-md-6">
                    <div class="card support-card p-4">
                        <h3>Tutoriales y Guías</h3>
                        <p class="text-muted small mb-2">Consulta nuestra documentación paso a paso:</p>
                        <ul>
                            <li>📖 <a href="guide1.php">Guía de Inicio Rápido</a></li>
                            <li>📖 <a href="guide2.php">Cómo Utilizar Nuestro Servicio</a></li>
                            <li>📖 <a href="guide3.php">Solución de Problemas Comunes</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <button id="back-button" class="btn btn-secondary px-4 py-2" style="border-radius: 8px;">Volver a la página anterior</button>
            </div>
        </div>
    </main>

    <!-- Footer Unificado -->
    <footer>
        <div class="container pt-4 pb-2">
            <div class="row text-left">
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="font-weight-bold mb-3">TechSolutions</h5>
                    <p class="small text-muted" style="color: #a8b2bc !important;">Soluciones tecnológicas integrales y soporte dedicado.</p>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 footer-links-list">
                    <h5 class="font-weight-bold mb-3">Enlaces</h5>
                    <a href="support.php" class="small">Soporte al usuario</a>
                    <a href="faq.php" class="small">Preguntas frecuentes</a>
                    <a href="terms.php" class="small">Términos y condiciones</a>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 footer-contact-list">
                    <h5 class="font-weight-bold mb-3">Contacto</h5>
                    <a href="mailto:info@empresa.com" class="small">📧 info@empresa.com</a>
                    <a href="chat.php" class="small">💬 Chat en vivo</a>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 footer-map">
                    <h5 class="font-weight-bold mb-3">Ubicación</h5>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2202.1106761658757!2d-102.35332368917338!3d21.83847508176745!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8429eb8c66ba4c57%3A0x800a85fa04315af2!2sUniversidad%20Tecnol%C3%B3gica%20de%20Aguascalientes!5e0!3m2!1ses-419!2smx!4v1720334252646!5m2!1ses-419!2smx" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </footer>

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