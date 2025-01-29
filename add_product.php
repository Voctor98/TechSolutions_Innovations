<?php
session_start();
include 'techsolutions.php';
include 'functions.php';

// Verificar permisos
check_permissions();

// Obtener todas las categorías
$categories_result = $conn->query("SELECT * FROM categories");

$product_added = false;
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $brand = $_POST['brand'];

    // Manejo de la imagen subida
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $image = basename($_FILES["image"]["name"]);

        $sql = "INSERT INTO articles (name, description, price, category, brand, image) VALUES ('$name', '$description', '$price', '$category', '$brand', '$image')";
        if ($conn->query($sql) === TRUE) {
            $product_added = true;
        } else {
            $error_message = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $error_message = "Error al subir la imagen.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Producto - TechSolutions Innovations</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar-brand img {
            max-width: 50px;
            margin-right: 10px;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .card-title {
            color: #0d6efd;
            font-weight: bold;
        }
        .form-group label {
            color: #0d6efd;
        }
        .form-control {
            background-color: #e9ecef;
        }
        .btn-success {
            background-color: #0d6efd;
            border: none;
        }
        .btn-success:hover {
            background-color: #0b5ed7;
        }
        .btn-secondary {
            background-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #5c636a;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">
            <img src="images/favicon.png" alt="TechSolutions Innovations">
            TechSolutions Innovations
        </a>
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
        </div>
    </nav>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title text-center">Agregar Producto</h1>
                <?php if ($product_added): ?>
                    <script>
                        window.onload = function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Producto agregado',
                                text: 'El producto ha sido agregado exitosamente.',
                                onClose: () => {
                                    window.location.href = 'products.php';
                                }
                            });
                        }
                    </script>
                <?php elseif (!empty($error_message)): ?>
                    <script>
                        window.onload = function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: '<?php echo $error_message; ?>'
                            });
                        }
                    </script>
                <?php endif; ?>
                <form action="add_product.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Nombre del Producto:</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Descripción:</label>
                        <textarea id="description" name="description" class="form-control" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Precio:</label>
                        <input type="number" id="price" name="price" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="category">Categoría:</label>
                        <select id="category" name="category" class="form-control" required>
                            <option value="">Selecciona una categoría</option>
                            <?php
                            if ($categories_result->num_rows > 0) {
                                while($cat = $categories_result->fetch_assoc()) {
                                    echo "<option value='" . $cat['name'] . "'>" . $cat['name'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="brand">Marca:</label>
                        <input type="text" id="brand" name="brand" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Imagen del Producto:</label>
                        <input type="file" id="image" name="image" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Agregar Producto</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrap.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>
</html>
