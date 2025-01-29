<?php
session_start();
include 'techsolutions.php';
include 'functions.php';

// Verificar permisos
check_permissions();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM articles WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $product = $result->fetch_assoc();
    } else {
        echo "Producto no encontrado.";
        exit();
    }
} else {
    echo "ID de producto no especificado.";
    exit();
}

$product_updated = false;
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    
    // Manejar la carga de la imagen
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $image = basename($_FILES['image']['name']);
        $target_dir = __DIR__ . "/uploads/"; // Utiliza una ruta absoluta
        $target_file = $target_dir . $image;

        // Comprobación del tipo de archivo (opcional)
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowed_types)) {
            $error_message = "Solo se permiten archivos JPG, JPEG, PNG y GIF.";
        } else {
            // Mover el archivo subido a la carpeta de destino
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                // Actualizar la base de datos con el nuevo nombre de archivo
                $sql = "UPDATE articles SET name='$name', description='$description', price='$price', image='$image' WHERE id='$id'";
                if ($conn->query($sql) === TRUE) {
                    $product_updated = true;
                } else {
                    $error_message = "Error al actualizar el producto: " . $conn->error;
                }
            } else {
                $error_message = "Error al subir la imagen.";
            }
        }
    } else {
        // Si no se subió ninguna imagen nueva, solo actualizar los otros campos
        $sql = "UPDATE articles SET name='$name', description='$description', price='$price' WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            $product_updated = true;
        } else {
            $error_message = "Error al actualizar el producto: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto - TechSolutions Innovations</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <style>
        /* Estilos */
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
        .btn-primary {
            background-color: #0d6efd;
            border: none;
        }
        .btn-primary:hover {
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
                <h1 class="card-title text-center">Editar Producto</h1>
                <?php if ($product_updated): ?>
                    <script>
                        window.onload = function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Producto actualizado',
                                text: 'El producto ha sido actualizado exitosamente.',
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
                <form action="edit_product.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($product['name']); ?>" required>
                        <div class="invalid-feedback">Por favor, ingrese el nombre del producto.</div>
                    </div>
                    <div class="form-group">
                        <label for="description">Descripción:</label>
                        <textarea id="description" name="description" class="form-control" rows="5" required><?php echo htmlspecialchars($product['description']); ?></textarea>
                        <div class="invalid-feedback">Por favor, ingrese la descripción del producto.</div>
                    </div>
                    <div class="form-group">
                        <label for="price">Precio:</label>
                        <input type="number" step="0.01" id="price" name="price" class="form-control" value="<?php echo htmlspecialchars($product['price']); ?>" required>
                        <div class="invalid-feedback">Por favor, ingrese el precio del producto.</div>
                    </div>
                    <div class="form-group">
                        <label for="image">Imagen actual:</label><br>
                        <img src="uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="Imagen del producto" width="150"><br><br>
                        <label for="image">Cambiar imagen:</label>
                        <input type="file" id="image" name="image" class="form-control-file">
                        <small class="form-text text-muted">Si no seleccionas una nueva imagen, se mantendrá la actual.</small>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrap.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
    </script>
</body>
</html>
