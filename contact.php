<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - TechSolutions Innovations</title>
    <link rel="icon" href="images/favicon.png" type="image/png">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <!-- Hoja de estilos principal -->
    <link rel="stylesheet" href="style.css">
    
    <style>
        /* Estilos específicos para la página de contacto */
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

        .hero-section p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        /* Subimos ligeramente el contenido principal para solaparlo con el hero */
        .contact-content-wrapper {
            margin-top: -60px;
            position: relative;
            z-index: 10;
            padding-bottom: 50px;
        }

        .contact-info-text p {
            margin-bottom: 1rem;
            font-size: 0.95rem;
            color: var(--text-muted, #6c757d);
        }

        .contact-info-text strong {
            color: var(--text-main, #333333);
        }

        /* Ajustes para el mapa en el footer */
        .footer-map iframe {
            border-radius: 8px;
            width: 100%;
            max-width: 250px;
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
    <!-- Header que aplica el efecto de cristal (Glassmorphism) del style.css -->
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
                    <li class="nav-item active"><a class="nav-link" href="contact.php">Contacto</a></li>
                    <?php if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin'): ?>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Cerrar Sesión</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="login.php">Iniciar Sesión</a></li>
                    <?php endif; ?>
                </ul>
                <form class="form-inline my-2 my-lg-0 ml-3" action="search.php" method="GET">
                    <input class="form-control mr-sm-2 form-control-sm" type="search" placeholder="Buscar..." aria-label="Buscar" name="query" style="border-radius: 20px;">
                    <button class="btn btn-outline-light btn-sm" type="submit" style="border-radius: 20px;">Buscar</button>
                </form>
            </div>
        </nav>
    </header>

    <main>
        <div class="hero-section">
            <div class="container">
                <h1>Ponte en Contacto con Nosotros</h1>
                <p>Estamos aquí para ayudarte. Envíanos un mensaje o visítanos en nuestras oficinas.</p>
            </div>
        </div>

        <section class="contact-content-wrapper">
            <div class="container">
                <div class="row">
                    <!-- Tarjeta de Información de Contacto -->
                    <div class="col-md-5 mb-4">
                        <div class="card h-100">
                            <div class="card-body p-4 contact-info-text">
                                <h3 class="h5 font-weight-bold mb-4">Información de Contacto</h3>
                                
                                <p><strong>📍 Dirección:</strong><br> Blvd. Juan Pablo II No. 1302 Ex hacienda la Cantera, 20200 Aguascalientes, Ags.</p>
                                <p><strong>📞 Teléfono:</strong><br> <a href="tel:+524491830065" class="text-decoration-none">+52 449 183 0065</a></p>
                                <p><strong>✉️ Email:</strong><br> <a href="mailto:info@techsolutions.com" class="text-decoration-none">info@techsolutions.com</a></p>
                                
                                <hr class="my-4">
                                
                                <h3 class="h6 font-weight-bold mb-3">Síguenos en nuestras redes</h3>
                                <div class="social-icons justify-content-start mt-0">
                                    <a href="https://www.facebook.com/voctor7u7" target="_blank" class="social-icon">
                                        <img src="images/facebook.png" alt="Facebook" width="28" height="28">
                                    </a>
                                    <a href="https://twitter.com/VctorMe90449678" target="_blank" class="social-icon">
                                        <img src="images/twitter.png" alt="Twitter" width="28" height="28">
                                    </a>
                                    <a href="https://www.instagram.com/victor.mendozap/" target="_blank" class="social-icon">
                                        <img src="images/instagram.png" alt="Instagram" width="28" height="28">
                                    </a>
                                    <a href="https://www.linkedin.com/in/v%C3%ADctor-mendoza-b23b80315/" target="_blank" class="social-icon">
                                        <img src="images/linkedin.png" alt="LinkedIn" width="28" height="28">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta del Formulario -->
                    <div class="col-md-7 mb-4">
                        <div class="card h-100">
                            <div class="card-body p-4 p-md-5">
                                <h3 class="h4 font-weight-bold mb-4 text-left">Envíanos un Mensaje</h3>
                                
                                <form id="contact-form" class="needs-validation text-left" novalidate>
                                    <div class="form-group">
                                        <label for="name" class="font-weight-500">Nombre completo</label>
                                        <input type="text" id="name" name="user_name" class="form-control" placeholder="Ej. Juan Pérez" required>
                                        <div class="invalid-feedback">Por favor, ingresa tu nombre.</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="font-weight-500">Correo electrónico</label>
                                        <input type="email" id="email" name="user_email" class="form-control" placeholder="ejemplo@correo.com" required>
                                        <div class="invalid-feedback">Por favor, ingresa un email válido.</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="message" class="font-weight-500">Mensaje</label>
                                        <textarea id="message" name="message" class="form-control" rows="4" placeholder="¿En qué podemos ayudarte?" required></textarea>
                                        <div class="invalid-feedback">Por favor, ingresa tu mensaje.</div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block mt-4">Enviar Mensaje</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer Modernizado -->
    <footer>
        <div class="container pt-4 pb-2">
            <div class="row text-left">
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="font-weight-bold mb-3">TechSolutions</h5>
                    <p class="small text-muted" style="color: #a8b2bc !important;">
                        Innovando el desarrollo de software y proporcionando soluciones tecnológicas integrales para tu negocio.
                    </p>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4 footer-links-list">
                    <h5 class="font-weight-bold mb-3">Enlaces Rápidos</h5>
                    <a href="support.php" class="small">Soporte al usuario</a>
                    <a href="faq.php" class="small">Preguntas frecuentes</a>
                    <a href="about.php" class="small">Acerca de nosotros</a>
                    <a href="terms.php" class="small">Términos y condiciones</a>
                    <a href="sitemap.html" class="small">Mapa del sitio</a>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 footer-contact-list">
                    <h5 class="font-weight-bold mb-3">Contacto</h5>
                    <a href="mailto:info@empresa.com" class="small">📧 info@empresa.com</a>
                    <a href="chat.php" class="small">💬 Chat en vivo</a>
                </div>

                <div class="col-lg-3 col-md-6 mb-4 footer-map">
                    <h5 class="font-weight-bold mb-3">Ubicación</h5>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2202.1106761658757!2d-102.35332368917338!3d21.83847508176745!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8429eb8c66ba4c57%3A0x800a85fa04315af2!2sUniversidad%20Tecnol%C3%B3gica%20de%20Aguascalientes!5e0!3m2!1ses-419!2smx!4v1720334252646!5m2!1ses-419!2smx" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            
            <div class="row mt-3 pt-3 border-top" style="border-color: rgba(255,255,255,0.1) !important;">
                <div class="col-12 text-center">
                    <p class="small text-muted mb-0" style="color: #a8b2bc !important;">&copy; <?php echo date("Y"); ?> TechSolutions Innovations. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.emailjs.com/dist/email.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    
    <script>
    (function() {
        'use strict';
        emailjs.init('CmcW5DX-iqKOIvhys'); // Clave pública

        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    } else {
                        event.preventDefault();
                        
                        // Botón en estado de carga (opcional pero muy profesional)
                        const submitBtn = form.querySelector('button[type="submit"]');
                        const originalText = submitBtn.innerText;
                        submitBtn.innerText = 'Enviando...';
                        submitBtn.disabled = true;

                        emailjs.sendForm('service_39jrzfh', 'template_i98agua', form)
                            .then(function() {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Mensaje enviado',
                                    text: 'Tu mensaje ha sido enviado exitosamente.',
                                    confirmButtonColor: '#0062E6'
                                });
                                form.reset();
                                form.classList.remove('was-validated');
                            }, function(error) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Ocurrió un error al enviar tu mensaje. Por favor, inténtalo nuevamente.',
                                    confirmButtonColor: '#0062E6'
                                });
                            }).finally(function() {
                                submitBtn.innerText = originalText;
                                submitBtn.disabled = false;
                            });
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
    </script>
</body>
</html>