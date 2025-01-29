<?php
session_start();
include 'techsolutions.php';

if (!isset($_GET['id'])) {
    die('ID de producto no proporcionado');
}

$id = $conn->real_escape_string($_GET['id']);
$sql = "SELECT * FROM articles WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die('Producto no encontrado');
}

$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($product['name']); ?> - TechSolutions Innovations</title>
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
        .product-details {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }
        .product-image {
            max-width: 100%;
            max-height: 500px;
            object-fit: contain;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-30px);
            }
            60% {
                transform: translateY(-15px);
            }
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        @keyframes fadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }
        @keyframes slideDown {
            from {
                transform: translateY(-100%);
            }
            to {
                transform: translateY(0);
            }
        }
        @keyframes slideUp {
            from {
                transform: translateY(0);
            }
            to {
                transform: translateY(-100%);
            }
        }
        @keyframes shake {
            0% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            50% { transform: translateX(5px); }
            75% { transform: translateX(-5px); }
            100% { transform: translateX(0); }
        }
        .bounce {
            animation: bounce 1s;
        }
        .fadeIn {
            animation: fadeIn 1s;
        }
        .fadeOut {
            animation: fadeOut 1s;
        }
        .slideDown {
            animation: slideDown 1s;
        }
        .slideUp {
            animation: slideUp 1s;
        }
        .shake {
            animation: shake 0.5s;
        }
        .navbar-hidden {
            transform: translateY(-100%);
            transition: transform 0.3s;
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
        <div class="product-details">
            <h1 class="text-center"><?php echo htmlspecialchars($product['name']); ?></h1>
            <img src="images/<?php echo htmlspecialchars($product['image']); ?>" class="product-image mx-auto d-block" alt="<?php echo htmlspecialchars($product['name']); ?>">
            <p><strong>Descripción:</strong> <?php echo htmlspecialchars($product['description']); ?></p>
            <p><strong>Precio:</strong> $<?php echo htmlspecialchars($product['price']); ?></p>
            <p><strong>Categoría:</strong> <?php echo htmlspecialchars($product['category']); ?></p>
            <p><strong>Marca:</strong> <?php echo htmlspecialchars($product['brand']); ?></p>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrap.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
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
