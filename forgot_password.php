<?php
session_start();
include 'techsolutions.php';

$notification = '';
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    
    // Verificar si el correo electrónico existe en la base de datos
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $token = bin2hex(random_bytes(50));
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Guardar el token y su expiración en la base de datos
        $stmt = $conn->prepare("UPDATE users SET reset_token=?, reset_token_expiry=? WHERE email=?");
        $stmt->bind_param("sss", $token, $expiry, $email);
        if ($stmt->execute()) {
            // Enviar el correo electrónico con el enlace de restablecimiento
            echo "<script>
                window.onload = function() {
                    emailjs.send('service_39jrzfh', 'template_r8m23rk', {
                        to_email: '$email',
                        reset_link: 'http://localhost/TechSolutions%20_Innovations/reset_password.php?token=$token'
                    }).then(function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Correo de recuperación enviado',
                            text: 'Por favor, revisa tu bandeja de entrada.',
                        });
                    }, function(error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error al enviar el correo. Por favor, intenta de nuevo.',
                        });
                    });
                };
            </script>";
        } else {
            $error_message = "Error al generar el token de restablecimiento.";
        }
    } else {
        $error_message = "No se encontró una cuenta con ese correo electrónico.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Contraseña - TechSolutions Innovations</title>
    <link rel="icon" href="images/favicon.png" type="image/png">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <style>
        .forgot-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .forgot-card {
            width: 100%;
            max-width: 400px;
            border: none;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .logo {
            max-width: 100px; /* Ajusta el tamaño del logotipo según sea necesario */
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">
            <img src="images/favicon.png" alt="Logotipo de TechSolutions Innovations" class="logo"> <!-- Ruta del logotipo -->
            TechSolutions Innovations
        </a>
    </nav>
    <div class="forgot-container">
        <div class="card forgot-card">
            <div class="card-body">
                <h2 class="card-title text-center">Recuperar Contraseña</h2>
                <?php if (!empty($error_message)): ?>
                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                <?php endif; ?>
                <form action="forgot_password.php" method="post" class="needs-validation" novalidate>
                    <div class="form-group">
                        <label for="email">Correo Electrónico:</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                        <div class="invalid-feedback">Por favor, ingresa tu correo electrónico.</div>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Enviar Enlace de Recuperación</button>
                </form>
                <a href="index.php" class="btn btn-secondary btn-block mt-3">Regresar al Inicio</a>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrap.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.emailjs.com/dist/email.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        (function() {
            emailjs.init('CmcW5DX-iqKOIvhys'); // Reemplaza 'YOUR_PUBLIC_KEY' con tu clave pública de EmailJS

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
