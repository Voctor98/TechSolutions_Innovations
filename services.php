<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios - TechSolutions Innovations</title>
    <link rel="icon" href="images/favicon.png" type="image/png">
    
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Hoja de estilos principal -->
    <link rel="stylesheet" href="style.css">
    
    <style>
        /* Estilos específicos para la página de Servicios */
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

        /* Envoltorio para solapar el contenido con el hero */
        .services-content-wrapper {
            margin-top: -60px;
            position: relative;
            z-index: 10;
            padding-bottom: 50px;
        }

        .service-card {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-top: 4px solid var(--primary-blue, #0062E6);
            height: 100%;
        }
        
        .service-icon {
            font-size: 2.5rem;
            margin-bottom: 20px;
            display: inline-block;
            background: rgba(0, 98, 230, 0.1);
            width: 70px;
            height: 70px;
            line-height: 70px;
            border-radius: 50%;
            text-align: center;
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
    <!-- Header con efecto Glassmorphism -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-transparent p-0">
            <a class="navbar-brand font-weight-bold" href="index.php">TechSolutions Innovations</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                    <li class="nav-item active"><a class="nav-link" href="services.php">Servicios</a></li>
                    <li class="nav-item"><a class="nav-link" href="products.php">Productos</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">Nosotros</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contacto</a></li>
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
        <!-- Hero Section -->
        <div class="hero-section">
            <div class="container">
                <h1>Nuestros Servicios</h1>
                <p>Descubre nuestras soluciones tecnológicas de vanguardia diseñadas para tu negocio.</p>
            </div>
        </div>

        <!-- Contenido Principal -->
        <section class="services-content-wrapper container">
            
            <!-- Mensaje Informativo -->
            <div class="card mb-5 border-0 bg-white">
                <div class="card-body p-4 text-center">
                    <p class="text-muted mb-0 mx-auto" style="max-width: 700px;">
                        <em>Nota: Esta página es exclusivamente informativa para aquellos usuarios que necesiten conocer la dinámica y presentación de nuestros productos.</em>
                    </p>
                </div>
            </div>

            <!-- Presentación de Productos (Servicios) -->
            <div class="text-center mb-5">
                <h2 class="h3 font-weight-bold mb-5">Características de nuestra plataforma</h2>
                <div class="row">
                    <!-- Servicio 1: Catálogo -->
                    <div class="col-md-4 mb-4">
                        <div class="card p-4 service-card">
                            <div class="text-center">
                                <span class="service-icon">💻</span>
                            </div>
                            <h3 class="h5 font-weight-bold mb-3 text-center">Catálogo de Productos</h3>
                            <p class="text-muted small text-center mb-0">
                                Mostramos una lista detallada de productos electrónicos y de computación, incluyendo especificaciones técnicas, galerías de imágenes de alta resolución y precios actualizados en tiempo real.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Servicio 2: Búsqueda -->
                    <div class="col-md-4 mb-4">
                        <div class="card p-4 service-card">
                            <div class="text-center">
                                <span class="service-icon">🔍</span>
                            </div>
                            <h3 class="h5 font-weight-bold mb-3 text-center">Búsqueda Inteligente</h3>
                            <p class="text-muted small text-center mb-0">
                                Funcionalidades avanzadas para buscar productos rápidamente. Podrás filtrar tus resultados por categoría, rango de precios, marca y disponibilidad en inventario.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Servicio 3: Comparación -->
                    <div class="col-md-4 mb-4">
                        <div class="card p-4 service-card">
                            <div class="text-center">
                                <span class="service-icon">⚖️</span>
                            </div>
                            <h3 class="h5 font-weight-bold mb-3 text-center">Comparador</h3>
                            <p class="text-muted small text-center mb-0">
                                Herramienta intuitiva que permite a los usuarios colocar productos lado a lado para comparar características, rendimiento y precios antes de tomar una decisión de compra.
                            </p>
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
</body>
</html>