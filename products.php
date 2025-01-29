<?php
session_start();
include 'techsolutions.php';

// Obtener todas las categorías
$categories_result = $conn->query("SELECT * FROM categories");

// Obtener parámetros de búsqueda y filtros
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$category = isset($_GET['category']) ? $conn->real_escape_string($_GET['category']) : '';
$min_price = isset($_GET['min_price']) ? (float)$_GET['min_price'] : '';
$max_price = isset($_GET['max_price']) ? (float)$_GET['max_price'] : '';
$brand = isset($_GET['brand']) ? $conn->real_escape_string($_GET['brand']) : '';

// Construir la consulta SQL con los filtros
$sql = "SELECT * FROM articles WHERE (name LIKE '%$search%' OR description LIKE '%$search%')";

if ($category) {
    $sql .= " AND category = '$category'";
}
if ($min_price) {
    $sql .= " AND price >= $min_price";
}
if ($max_price) {
    $sql .= " AND price <= $max_price";
}
if ($brand) {
    $sql .= " AND brand = '$brand'";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos - TechSolutions Innovations</title>
    <link rel="icon" href="images/favicon.png" type="image/png">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
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
        .product-card {
            transition: transform 0.3s;
            height: 700px; /* Altura fija para todas las tarjetas */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-align: center; /* Alineación centrada del contenido */
        }
        
        .product-card:hover {
            transform: scale(1.05);
        }
        .product-card img {
            margin: 0 auto; /* Centrar imagen */
        }
        .card-body {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .btn-warning, .btn-danger {
            margin-right: 5px;
        }
        .search-form {
            margin-bottom: 30px;
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
    <header class="bg-primary text-white text-center py-5">
        <h1>Productos</h1>
    </header>
    <section id="product-gallery" class="container my-5 content">
        <form method="GET" action="products.php" class="search-form">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="Buscar productos..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                </div>
                <div class="col-md-2">
                    <select name="category" class="form-control">
                        <option value="">Categoría</option>
                        <?php
                        if ($categories_result->num_rows > 0) {
                            while($cat = $categories_result->fetch_assoc()) {
                                echo "<option value='" . $cat['name'] . "'" . ($category == $cat['name'] ? 'selected' : '') . ">" . $cat['name'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="number" name="min_price" class="form-control" placeholder="Precio Mín." value="<?php echo isset($_GET['min_price']) ? htmlspecialchars($_GET['min_price']) : ''; ?>">
                </div>
                <div class="col-md-2">
                    <input type="number" name="max_price" class="form-control" placeholder="Precio Máx." value="<?php echo isset($_GET['max_price']) ? htmlspecialchars($_GET['max_price']) : ''; ?>">
                </div>
                <div class="col-md-2">
                    <select name="brand" class="form-control">
                        <option value="">Marca</option>
                        <option value="HP" <?php echo $brand == 'HP' ? 'selected' : ''; ?>>HP</option>
                        <option value="Samsung" <?php echo $brand == 'Samsung' ? 'selected' : ''; ?>>Samsung</option>
                        <option value="Sony" <?php echo $brand == 'Sony' ? 'selected' : ''; ?>>Sony</option>
                        <option value="Dell" <?php echo $brand == 'Dell' ? 'selected' : ''; ?>>Dell</option>
                        <option value="Logitech" <?php echo $brand == 'Logitech' ? 'selected' : ''; ?>>Logitech</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-primary" type="submit">Buscar</button>
                </div>
                <div class="col-md-1">
                    <a href="products.php" class="btn btn-secondary">Resetear</a>
                </div>
            </div>
        </form>
        <?php if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin'): ?>
            <a href="add_product.php" class="btn btn-primary mb-4">Agregar Producto</a>
        <?php endif; ?>
        <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='col-md-4' data-aos='fade-up'><div class='card mb-4 product-card'><img src='images/".$row["image"]."' class='img-fluid mx-auto' alt='".$row["name"]."' style='height: 200px; object-fit: contain;'><div class='card-body'><h2 class='card-title'>" . $row["name"]. "</h2><p class='card-text'>" . $row["description"]. "</p><p class='card-text'>Precio: $" . $row["price"]. "</p>";
                if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin') {
                    echo "<a href='edit_product.php?id=".$row["id"]."' class='btn btn-warning'>Editar</a>";
                    echo "<a href='delete_product.php?id=".$row["id"]."' class='btn btn-danger'>Eliminar</a>";
                }
                echo "<a href='product_details.php?id=".$row["id"]."' class='btn btn-primary'>Ver Detalles</a>";
                echo "</div></div></div>";
            }
        } else {
            echo "<p class='text-center'>No se encontraron productos</p>";
        }
        $conn->close();
        ?>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrap.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        AOS.init();
        
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

            // Añadir eventos adicionales a elementos específicos
            $('.product-card').on('click', function() {
                $(this).addClass('shake');
                setTimeout(() => $(this).removeClass('shake'), 500);
            });
        });

        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            Swal.fire({
                icon: 'success',
                title: 'Producto agregado',
                text: 'El producto ha sido agregado exitosamente.'
            });
        <?php endif; ?>
        <?php if (isset($_GET['edit_success']) && $_GET['edit_success'] == 1): ?>
            Swal.fire({
                icon: 'success',
                title: 'Producto editado',
                text: 'El producto ha sido editado exitosamente.'
            });
        <?php endif; ?>
        <?php if (isset($_GET['delete_success']) && $_GET['delete_success'] == 1): ?>
            Swal.fire({
                icon: 'success',
                title: 'Producto eliminado',
                text: 'El producto ha sido eliminado exitosamente.'
            });
        <?php endif; ?>
        <?php if (isset($_GET['delete_error']) && $_GET['delete_error'] == 1): ?>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Ocurrió un error al intentar eliminar el producto.'
            });
        <?php endif; ?>
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