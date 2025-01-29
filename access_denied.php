<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso Denegado</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Open Sans', sans-serif;
        }
        .access-denied-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .access-denied-card {
            width: 100%;
            max-width: 400px;
            border: none;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: center;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
        }
        .access-denied-header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            border-radius: 10px 10px 0 0;
        }
        .btn-primary, .btn-secondary {
            margin-top: 10px;
            padding: 10px 20px;
            border-radius: 5px;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="access-denied-container">
        <div class="card access-denied-card">
            <div class="access-denied-header">
                <h2 class="card-title text-center">Acceso Denegado</h2>
            </div>
            <div class="card-body">
                <p>No tienes permisos para acceder a esta página.</p>
                <a href="login.php" class="btn btn-primary">Iniciar Sesión</a>
                <a href="index.php" class="btn btn-secondary">Regresar al Inicio</a>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Acceso Denegado',
                text: 'No tienes permisos para acceder a esta página.',
                confirmButtonText: 'Entendido'
            });
        });
    </script>
</body>
</html>
