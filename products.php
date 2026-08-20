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
if ($category) $sql .= " AND category = '$category'";
if ($min_price) $sql .= " AND price >= $min_price";
if ($max_price) $sql .= " AND price <= $max_price";
if ($brand) $sql .= " AND brand = '$brand'";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - TechSolutions Innovations</title>
    <link rel="icon" href="images/favicon.png" type="image/png">
    <link rel="stylesheet" href="style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <style>
        .hero-section {
            background: linear-gradient(135deg, rgba(0, 98, 230, 0.85), rgba(51, 174, 255, 0.85)), url('images/hero-bg.jpg');
            background-size: cover;
            background-position: center;
            padding: 80px 20px;
            color: #fff;
            text-align: center;
        }
        .filter-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            padding: 20px;
            margin-bottom: 30px;
        }
        .product-card {
            border-radius: 12px;
            overflow: hidden;
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .product-img { height: 200px; object-fit: contain; padding: 15px; }
        .footer-map iframe { border-radius: 8px; width: 100%; height: 150px; }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
            <a class="navbar-brand font-weight-bold" href="index.php">TechSolutions Innovations</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                    <li class="nav-item active"><a class="nav-link" href="products.php">Productos</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">Nosotros</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contacto</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="hero-section">
        <h1>Nuestros Productos</h1>
    </div>

    <section class="container my-5">
        <div class="filter-card">
            <form method="GET" action="products.php" class="row">
                <div class="col-md-3 mb-2"><input type="text" name="search" class="form-control" placeholder="Buscar..." value="<?= htmlspecialchars($search) ?>"></div>
                <div class="col-md-2 mb-2">
                    <select name="category" class="form-control">
                        <option value="">Categoría</option>
                        <?php while($cat = $categories_result->fetch_assoc()) echo "<option value='".$cat['name']."' ".($category == $cat['name'] ? 'selected' : '').">".$cat['name']."</option>"; ?>
                    </select>
                </div>
                <div class="col-md-2 mb-2"><input type="number" name="min_price" class="form-control" placeholder="Min $" value="<?= $min_price ?>"></div>
                <div class="col-md-2 mb-2"><input type="number" name="max_price" class="form-control" placeholder="Max $" value="<?= $max_price ?>"></div>
                <div class="col-md-3 text-right">
                    <button class="btn btn-primary" type="submit">Buscar</button>
                    <a href="products.php" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>

        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
            <a href="add_product.php" class="btn btn-success mb-4">+ Agregar Producto</a>
        <?php endif; ?>

        <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='col-md-4 mb-4' data-aos='fade-up'>
                        <div class='card product-card h-100'>
                            <img src='images/".$row["image"]."' class='product-img' alt='".$row["name"]."'>
                            <div class='card-body d-flex flex-column'>
                                <h5 class='font-weight-bold'>".$row["name"]."</h5>
                                <p class='text-muted small'>".$row["description"]."</p>
                                <p class='font-weight-bold text-primary'>$".$row["price"]."</p>
                                <div class='mt-auto'>";
                if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                    echo "<a href='edit_product.php?id=".$row["id"]."' class='btn btn-warning btn-sm'>Editar</a>
                          <a href='delete_product.php?id=".$row["id"]."' class='btn btn-danger btn-sm'>Eliminar</a>";
                }
                echo "<a href='product_details.php?id=".$row["id"]."' class='btn btn-primary btn-sm'>Ver Detalles</a>
                                </div>
                            </div>
                        </div>
                      </div>";
            }
        } else {
            echo "<p class='text-center w-100'>No se encontraron productos.</p>";
        }
        $conn->close();
        ?>
        </div>
    </section>

    <footer>
        <div class="container pt-4 text-left">
            <div class="row">
                <div class="col-md-6"><h5 class="font-weight-bold">TechSolutions</h5><p class="small text-muted">Soluciones integrales de software.</p></div>
                <div class="col-md-3 footer-links-list"><a href="support.php">Soporte</a><a href="faq.php">FAQ</a></div>
                <div class="col-md-3 footer-contact-list"><a href="mailto:info@techsolutions.com">📧 info@techsolutions.com</a></div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>AOS.init();</script>
</body>
</html>