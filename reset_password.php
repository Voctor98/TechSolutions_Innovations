<?php
session_start();
include 'techsolutions.php';

// Establecer la zona horaria a la Ciudad de México
date_default_timezone_set('America/Mexico_City');

$reset_success = false;
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizar entradas
    $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
    $new_password = filter_input(INPUT_POST, 'new_password', FILTER_SANITIZE_STRING);
    $confirm_password = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_STRING);

    // Verificar si el token es válido y no ha expirado
    $sql = "SELECT * FROM users WHERE reset_token=? AND reset_token_expiry > NOW()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $username = $user['username'];

        // Verificar que las contraseñas coincidan
        if ($new_password !== $confirm_password) {
            $error_message = "Las contraseñas no coinciden.";
            $log_message = date('Y-m-d H:i:s') . " - $username - Intento fallido de cambio de contraseña: Las contraseñas no coinciden\n";
            file_put_contents('password_reset.log', $log_message, FILE_APPEND);
        } elseif (strlen($new_password) < 8) {
            $error_message = "La nueva contraseña debe tener al menos 8 caracteres.";
            $log_message = date('Y-m-d H:i:s') . " - $username - Intento fallido de cambio de contraseña: La nueva contraseña debe tener al menos 8 caracteres\n";
            file_put_contents('password_reset.log', $log_message, FILE_APPEND);
        } elseif (!preg_match('/[A-Z]/', $new_password) ||
                  !preg_match('/[a-z]/', $new_password) ||
                  !preg_match('/[0-9]/', $new_password) ||
                  !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $new_password)) {
            $error_message = "La contraseña debe incluir al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.";
            $log_message = date('Y-m-d H:i:s') . " - $username - Intento fallido de cambio de contraseña: La contraseña no cumple con los requisitos de complejidad\n";
            file_put_contents('password_reset.log', $log_message, FILE_APPEND);
        } else {
            // Hashear la nueva contraseña
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Actualizar la contraseña
            $sql = "UPDATE users SET password=?, reset_token=NULL, reset_token_expiry=NULL WHERE reset_token=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $hashed_password, $token);
            if ($stmt->execute()) {
                $reset_success = true;
                // Registrar el evento de cambio de contraseña
                $log_message = date('Y-m-d H:i:s') . " - $username - Contraseña actualizada\n";
                file_put_contents('password_reset.log', $log_message, FILE_APPEND);
            } else {
                $error_message = "Error al restablecer la contraseña.";
            }
        }
    } else {
        $error_message = "Token inválido o expirado.";
    }
} else {
    if (isset($_GET['token'])) {
        $token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_STRING);
    } else {
        $error_message = "Token no proporcionado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Restablecer Contraseña - TechSolutions Innovations</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .reset-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .reset-card {
            width: 100%;
            max-width: 400px;
            border: none;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
    </style>
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
</head>
<body>
    <div class="reset-container">
        <div class="card reset-card">
            <div class="card-body">
                <h2 class="card-title text-center">Restablecer Contraseña</h2>
                <form action="reset_password.php" method="post" class="needs-validation" novalidate>
                    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                    <div class="form-group">
                        <label for="new_password">Nueva Contraseña:</label>
                        <input type="password" id="new_password" name="new_password" class="form-control" required>
                        <div class="invalid-feedback">Por favor, ingrese su nueva contraseña.</div>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirmar Nueva Contraseña:</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                        <div class="invalid-feedback">Por favor, confirme su nueva contraseña.</div>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Restablecer Contraseña</button>
                </form>
                <a href="index.php" class="btn btn-secondary btn-block mt-3">Regresar al Inicio</a>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrap.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- SweetAlert JS -->
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

        <?php if ($reset_success): ?>
            Swal.fire({
                icon: 'success',
                title: 'Contraseña restablecida',
                text: 'Tu contraseña ha sido restablecida con éxito.',
                onClose: () => {
                    window.location.href = 'login.php';
                }
            });
        <?php elseif (!empty($error_message)): ?>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '<?php echo $error_message; ?>'
            });
        <?php endif; ?>
    })();
    </script>
</body>
</html>
