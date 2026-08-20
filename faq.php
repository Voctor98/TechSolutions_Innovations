<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preguntas Frecuentes - TechSolutions Innovations</title>
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
        .faq-wrapper {
            margin-top: -60px;
            position: relative;
            z-index: 10;
        }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .card-header { background: #fff; border-bottom: 1px solid #f1f3f5; }
        .btn-link { font-weight: 600; color: #333; text-decoration: none; }
        .btn-link:hover { color: var(--primary-blue, #0062E6); text-decoration: none; }
        .footer-map iframe { border-radius: 8px; width: 100%; height: 150px; }
    </style>
</head>
<body>
    <!-- Header unificado -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-transparent p-0">
            <a class="navbar-brand font-weight-bold" href="index.php">TechSolutions Innovations</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="services.php">Servicios</a></li>
                    <li class="nav-item"><a class="nav-link" href="products.php">Productos</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">Nosotros</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contacto</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <div class="hero-section">
            <div class="container">
                <h1>Preguntas Frecuentes</h1>
                <p>Todo lo que necesitas saber sobre nuestros servicios y productos.</p>
            </div>
        </div>

        <div class="container faq-wrapper">
            <div class="card p-4 p-md-5">
                <div class="accordion" id="faqAccordion">
                    <!-- Pregunta 1 -->
                    <div class="card border-bottom">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne">
                                    1. ¿Qué servicios ofrece TechSolutions Innovations?
                                </button>
                            </h2>
                        </div>
                        <div id="collapseOne" class="collapse show" data-parent="#faqAccordion">
                            <div class="card-body text-muted">Ofrecemos consultoría tecnológica, desarrollo de software personalizado y soporte técnico especializado.</div>
                        </div>
                    </div>
                    <!-- Pregunta 2 -->
                    <div class="card border-bottom">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo">
                                    2. ¿Cómo puedo contactar con TechSolutions Innovations?
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" data-parent="#faqAccordion">
                            <div class="card-body text-muted">Puedes usar nuestro formulario de contacto o llamarnos al +52 449 183 0065.</div>
                        </div>
                    </div>
                    <!-- Pregunta 3 -->
                    <div class="card border-bottom">
                        <div class="card-header" id="headingThree">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree">
                                    3. ¿Qué productos vende TechSolutions Innovations?
                                </button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" data-parent="#faqAccordion">
                            <div class="card-body text-muted">Contamos con una amplia gama de productos como laptops, smartphones y accesorios de computación.</div>
                        </div>
                    </div>
                    <!-- Pregunta 4 -->
                    <div class="card border-bottom">
                        <div class="card-header" id="headingFour">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFour">
                                    4. ¿Dónde está ubicada la empresa?
                                </button>
                            </h2>
                        </div>
                        <div id="collapseFour" class="collapse" data-parent="#faqAccordion">
                            <div class="card-body text-muted">Nuestra oficina principal está en Blvd. Juan Pablo II No. 1302, Aguascalientes, Ags.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer Unificado -->
    <footer class="mt-5">
        <div class="container pt-4">
            <div class="row text-left">
                <div class="col-md-3"><h5 class="font-weight-bold">TechSolutions</h5><p class="small text-muted">Innovación constante.</p></div>
                <div class="col-md-3 footer-links-list"><a href="support.php">Soporte</a><a href="faq.php">FAQ</a></div>
                <div class="col-md-3 footer-contact-list"><a href="mailto:info@techsolutions.com">info@techsolutions.com</a></div>
                <div class="col-md-3 footer-map"><iframe src="..."></iframe></div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>