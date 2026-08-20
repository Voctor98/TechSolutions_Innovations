<?php
session_start();
include 'techsolutions.php';

$admin_login = isset($_SESSION['username']) && $_SESSION['role'] == 'admin';
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio - TechSolutions Innovations</title>
    <link rel="manifest" href="manifest.json">
    <link rel="icon" href="images/favicon.png" type="image/png">
    <link rel="stylesheet" href="style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    
    <style>
        .hero-section {
            background: linear-gradient(135deg, rgba(0, 98, 230, 0.85), rgba(51, 174, 255, 0.85)), url('images/hero-bg.jpg');
            background-size: cover;
            background-position: center;
            padding: 120px 20px;
            color: #fff;
            text-align: center;
        }
        .hero-section h1 { font-weight: 700; margin-bottom: 20px; }
        .carousel-inner img { height: 450px; object-fit: cover; border-radius: 12px; }
        .footer-map iframe { border-radius: 8px; width: 100%; height: 150px; }
        .footer-links-list a, .footer-contact-list a { color: #a8b2bc; display: block; margin-bottom: 8px; transition: color 0.3s; }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
            <a class="navbar-brand font-weight-bold" href="index.php">TechSolutions Innovations</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a class="nav-link" href="index.php">Inicio</a></li>
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

    <div class="hero-section">
        <h1>Bienvenidos a TechSolutions</h1>
        <p class="lead">Soluciones tecnológicas de vanguardia para tu negocio.</p>
        <?php if (isset($_SESSION['username'])): ?>
            <div class="mt-4 alert alert-light d-inline-block text-dark">Bienvenido, <?php echo $_SESSION['username']; ?></div>
        <?php endif; ?>
    </div>

    <section class="container my-5">
        <h2 class="text-center mb-4">Novedades en Tecnología</h2>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active"><img src="images/image1.jpg" class="d-block w-100" alt="S24"></div>
                <div class="carousel-item"><img src="images/image2.jpg" class="d-block w-100" alt="S24 Ultra"></div>
                <div class="carousel-item"><img src="images/image3.jpg" class="d-block w-100" alt="IA"></div>
            </div>
        </div>
    </section>

    <!-- Testimonios y Noticias (Secciones estandarizadas) -->
    <section class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <h3 class="mb-4">Lo que dicen de nosotros</h3>
                <?php
                $res = $conn->query("SELECT * FROM testimonials LIMIT 3");
                while($row = $res->fetch_assoc()) {
                    echo "<div class='card mb-3 p-3'><p><em>{$row['content']}</em></p><small class='text-primary'>- {$row['name']}</small></div>";
                }
                ?>
            </div>
            <div class="col-md-6">
                <h3 class="mb-4">Noticias Recientes</h3>
                <?php
                $res = $conn->query("SELECT * FROM news LIMIT 3");
                while($row = $res->fetch_assoc()) {
                    echo "<div class='card mb-3 p-3'><h5 class='h6 font-weight-bold'>{$row['title']}</h5><small class='text-muted'>{$row['date']}</small></div>";
                }
                ?>
            </div>
        </div>
    </section>

    <footer>
        <div class="container pt-4 text-left">
            <div class="row">
                <div class="col-md-3"><h5 class="font-weight-bold">TechSolutions</h5><p class="small text-muted">Innovando el futuro.</p></div>
                <div class="col-md-3 footer-links-list"><a href="support.php">Soporte</a><a href="faq.php">FAQ</a></div>
                <div class="col-md-3 footer-contact-list"><a href="mailto:info@techsolutions.com">info@techsolutions.com</a></div>
                <div class="col-md-3 footer-map"><iframe src="..."></iframe></div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        <?php if ($show_admin_message): ?>
            Swal.fire({ icon: 'success', title: 'Bienvenido Admin', text: 'Has iniciado sesión correctamente', timer: 3000 });
        <?php endif; ?>
    </script>
</body>
</html>