<?php
session_start();
include 'techsolutions.php';

// Verifica si el usuario es admin para mostrar el mensaje de bienvenida
$admin_login = isset($_SESSION['username']) && $_SESSION['role'] == 'admin';

// Verifica si es la primera vez que el administrador inicia sesión en esta sesión
$show_admin_message = false;
if ($admin_login && !isset($_SESSION['admin_welcome_shown'])) {
    $show_admin_message = true;
    $_SESSION['admin_welcome_shown'] = true;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Página de Inicio - TechSolutions Innovations</title>
    <link rel="manifest" href="manifest.json">
    <link rel="icon" href="images/favicon.png" type="image/png">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Open Sans', sans-serif;
            color: #333;
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
        .carousel-inner img {
            height: 500px;
            object-fit: cover;
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
        .carousel-item {
            transition: transform 0.6s ease-in-out;
        }
    </style>
</head>
<body>
    <!-- Menú de Navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
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
    <div class="container my-5 content text-center">
        <h1 class="text-dark">Bienvenidos a TechSolutions Innovations</h1>
        <?php if (isset($_SESSION['username'])): ?>
            <div class="admin-message">
                Bienvenido, <?php echo $_SESSION['username']; ?>.
            </div>
        <?php endif; ?>
    </div>
    <section id="welcome" class="container my-5 content">
        <h2 class="text-center">Bienvenidos</h2>
        <p class="text-center">En TechSolutions Innovations, estamos dedicados a ofrecerte la mejor tecnología y productos electrónicos de alta calidad. Nuestra misión es proporcionarte soluciones tecnológicas innovadoras que se adapten a tus necesidades. Explora nuestra página para descubrir más sobre nuestros productos y servicios.</p>
    </section>
    
    <!-- Carrusel de Imágenes -->
    <div id="carouselExampleIndicators" class="carousel slide my-5" data-ride="carousel" data-interval="2000">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/image1.jpg" class="d-block w-100" alt="Imagen 1">
                <div class="carousel-caption d-none d-md-block">
                    <p>GALAXY S24</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/image2.jpg" class="d-block w-100" alt="Imagen 2">
                <div class="carousel-caption d-none d-md-block">
                    <p>NUEVOS GALAXY S24 ULTRA</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/image3.jpg" class="d-block w-100" alt="Imagen 3">
                <div class="carousel-caption d-none d-md-block">
                    <p>DESCUBRE SU POTENTE AI</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/image4.avif" class="d-block w-100" alt="Imagen 4">
                <div class="carousel-caption d-none d-md-block">
                    <p>GALAXY S23 Y S23+</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Siguiente</span>
        </a>
    </div>

    <!-- Carrusel de Testimonios -->
    <section id="testimonials" class="container my-5 content">
        <h2 class="text-center">Los expertos dicen...</h2>
        <div id="testimonialCarousel" class="carousel slide" data-ride="carousel" data-interval="2000">
            <div class="carousel-inner">
                <?php
                $sql = "SELECT * FROM testimonials";
                $result = $conn->query($sql);
                $active = true;
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='carousel-item" . ($active ? " active" : "") . "'>";
                        echo "<div class='d-flex justify-content-center'>";
                        echo "<div class='card mb-4 testimonial'><div class='card-body'><p class='card-text'>" . $row["content"]. "</p><small class='text-muted'>- " . $row["name"]. ", " . $row["date"]. "</small></div></div>";
                        echo "</div></div>";
                        $active = false;
                    }
                } else {
                    echo "<p class='text-center'>No hay testimonios disponibles</p>";
                }
                ?>
            </div>
            <a class="carousel-control-prev" href="#testimonialCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#testimonialCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Siguiente</span>
            </a>
        </div>
    </section>

    <!-- Carrusel de Noticias -->
    <section id="news" class="container my-5 content">
        <h2 class="text-center">Blog/Noticias Recientes</h2>
        <div id="newsCarousel" class="carousel slide" data-ride="carousel" data-interval="2000">
            <div class="carousel-inner">
                <?php
                $sql = "SELECT * FROM news";
                $result = $conn->query($sql);
                $active = true;
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='carousel-item" . ($active ? " active" : "") . "'>";
                        echo "<div class='d-flex justify-content-center'>";
                        echo "<div class='card mb-4 news'><div class='card-body'><h3 class='card-title'>" . $row["title"]. "</h3><p class='card-text'>" . $row["content"]. "</p><small class='text-muted'>" . $row["date"]. "</small></div></div>";
                        echo "</div></div>";
                        $active = false;
                    }
                } else {
                    echo "<p class='text-center'>No hay noticias disponibles</p>";
                }
                ?>
            </div>
            <a class="carousel-control-prev" href="#newsCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#newsCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Siguiente</span>
            </a>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function(){
            $('.carousel').carousel();

            $('#carouselExampleIndicators').on('mouseenter', function () {
                $(this).carousel('pause');
            }).on('mouseleave', function () {
                $(this).carousel('cycle');
            });

            $('.card').on('mouseenter', function(){
                $(this).css('transform', 'scale(1.05)');
            }).on('mouseleave', function(){
                $(this).css('transform', 'scale(1)');
            });

            var lastScrollTop = 0;
            $(window).on('scroll', function() {
                var scrollTop = $(this).scrollTop();
                var scrollHeight = $(document).height();
                var windowHeight = $(window).height();

                if (scrollTop > lastScrollTop) {
                    // Scrolling down
                    $('.navbar').addClass('navbar-hidden');
                } else {
                    // Scrolling up
                    $('.navbar').removeClass('navbar-hidden');
                }
                lastScrollTop = scrollTop;

                if (scrollTop <= 0) {
                    $('body').addClass('bounce');
                    setTimeout(function() {
                        $('body').removeClass('bounce');
                    }, 1000);
                } else if (scrollTop + windowHeight >= scrollHeight) {
                    $('body').addClass('bounce');
                    setTimeout(function() {
                        $('body').removeClass('bounce');
                    }, 1000);
                }
            });

            $('.card').on('click', function() {
                $(this).addClass('shake');
                setTimeout(() => $(this).removeClass('shake'), 500);
            });

            $('.carousel-item').on('click', function() {
                $(this).addClass('rotate');
                setTimeout(() => $(this).removeClass('rotate'), 1000);
            });

            <?php if ($show_admin_message): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Bienvenido Admin',
                    text: 'Has iniciado sesión como administrador',
                    timer: 3000,
                    showConfirmButton: false
                });
            <?php endif; ?>
        });
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
