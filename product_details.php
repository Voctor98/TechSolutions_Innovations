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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?> - TechSolutions</title>
    <link rel="icon" href="images/favicon.png" type="image/png">
    <link rel="stylesheet" href="style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        .hero-section {
            background: linear-gradient(135deg, rgba(0, 98, 230, 0.85), rgba(51, 174, 255, 0.85));
            padding: 60px 20px;
            color: #fff;
            text-align: center;
        }
        .details-wrapper {
            margin-top: -50px;
            position: relative;
            z-index: 10;
        }
        .product-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            padding: 40px;
        }
        .product-image {
            width: 100%;
            height: auto;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .footer-map iframe { border-radius: 8px; width: 100%; height: 150px; }
        .footer-links-list a, .footer-contact-list a { color: #a8b2bc; display: block; margin-bottom: 8px; transition: color 0.3s; }
    </style>
</head>
<body>
    <!-- Header unificado -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
            <a class="navbar-brand font-weight-bold" href="index.php">TechSolutions Innovations</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="products.php">← Volver a Productos</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="hero-section">
        <h1>Detalles del Producto</h1>
    </div>

    <div class="container details-wrapper">
        <div class="card product-card">
            <div class="row">
                <div class="col-md-6">
                    <img src="images/<?php echo htmlspecialchars($product['image']); ?>" class="product-image" alt="<?php echo htmlspecialchars($product['name']); ?>">
                </div>
                <div class="col-md-6 d-flex flex-column justify-content-center mt-4 mt-md-0">
                    <h2 class="font-weight-bold mb-3"><?php echo htmlspecialchars($product['name']); ?></h2>
                    <h4 class="text-primary font-weight-bold mb-4">$<?php echo htmlspecialchars($product['price']); ?></h4>
                    
                    <div class="mb-4">
                        <h6 class="font-weight-bold">Descripción:</h6>
                        <p class="text-muted"><?php echo htmlspecialchars($product['description']); ?></p>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-6">
                            <h6 class="font-weight-bold">Categoría:</h6>
                            <p class="text-muted"><?php echo htmlspecialchars($product['category']); ?></p>
                        </div>
                        <div class="col-6">
                            <h6 class="font-weight-bold">Marca:</h6>
                            <p class="text-muted"><?php echo htmlspecialchars($product['brand']); ?></p>
                        </div>
                    </div>
                    
                    <a href="contact.php" class="btn btn-primary btn-lg w-100" style="border-radius: 8px;">Solicitar Información</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Unificado -->
    <footer class="mt-5">
        <div class="container pt-4 text-left">
            <div class="row">
                <div class="col-md-3"><h5 class="font-weight-bold">TechSolutions</h5><p class="small text-muted">Innovación y calidad.</p></div>
                <div class="col-md-3 footer-links-list"><a href="support.php">Soporte</a><a href="faq.php">FAQ</a></div>
                <div class="col-md-3 footer-contact-list"><a href="mailto:info@techsolutions.com">📧 info@techsolutions.com</a></div>
                <div class="col-md-3 footer-map"><iframe src="..."></iframe></div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>