<?php
session_start();
include 'techsolutions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizar entradas
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // Verificar si el usuario existe y obtener sus datos
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if ($user['is_locked']) {
            $lock_time = strtotime($user['lock_time']);
            $current_time = time();
            $lock_duration = 2 * 60; // 2 minutos

            if ($current_time - $lock_time > $lock_duration) {
                // Desbloquear usuario después de 2 minutos
                $stmt = $conn->prepare("UPDATE users SET failed_attempts = 0, is_locked = 0, lock_time = NULL WHERE username=?");
                $stmt->bind_param("s", $username);
                $stmt->execute();
            } else {
                $error = "Tu cuenta está bloqueada. Inténtalo de nuevo en " . (2 - floor(($current_time - $lock_time) / 60)) . " minutos.";
            }
        } elseif (password_verify($password, $user['password']) && $user['role'] == 'admin') {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = 'admin';

            // Reiniciar el contador de intentos fallidos
            $stmt = $conn->prepare("UPDATE users SET failed_attempts = 0, is_locked = 0, lock_time = NULL WHERE username=?");
            $stmt->bind_param("s", $username);
            $stmt->execute();

            // Registrar el evento de login exitoso
            $log_message = date('Y-m-d H:i:s') . " - $username - Login exitoso\n";
            file_put_contents('login_logout.log', $log_message, FILE_APPEND);

            header("Location: index.php");
            exit();
        } else {
            // Incrementar el contador de intentos fallidos
            $stmt = $conn->prepare("UPDATE users SET failed_attempts = failed_attempts + 1 WHERE username=?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $user['failed_attempts'] += 1;

            if ($user['failed_attempts'] >= 3) {
                // Registrar el evento de login fallido y marcar usuario como bloqueado
                $stmt = $conn->prepare("UPDATE users SET is_locked = 1, lock_time = NOW() WHERE username=?");
                $stmt->bind_param("s", $username);
                $stmt->execute();
                
                // Registrar el evento de bloqueo
                $log_message = date('Y-m-d H:i:s') . " - $username - Cuenta bloqueada\n";
                file_put_contents('login_logout.log', $log_message, FILE_APPEND);
                
                // Enviar notificación por EmailJS utilizando JavaScript
                echo "<script>
                    window.onload = function() {
                        emailjs.send('service_39jrzfh', 'template_i98agua', {
                            username: '$username',
                            message: 'El usuario $username ha superado el número permitido de intentos fallidos de inicio de sesión.',
                            to_email: 'victormendozapalacio@gmail.com' // Reemplaza con el correo del administrador
                        }).then(function() {
                            console.log('Correo enviado exitosamente');
                        }, function(error) {
                            console.log('Error al enviar el correo:', error);
                        });
                    };
                </script>";
                $error = "Tu cuenta ha sido bloqueada debido a múltiples intentos fallidos de inicio de sesión.";
            } else {
                $error = "Usuario o contraseña incorrectos. Intentos fallidos: " . $user['failed_attempts'];
                
                // Registrar el evento de login fallido
                $log_message = date('Y-m-d H:i:s') . " - $username - Login fallido\n";
                file_put_contents('login_logout.log', $log_message, FILE_APPEND);
            }
        }
    } else {
        $error = "Usuario o contraseña incorrectos.";
        
        // Registrar el evento de login fallido
        $log_message = date('Y-m-d H:i:s') . " - $username - Login fallido\n";
        file_put_contents('login_logout.log', $log_message, FILE_APPEND);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login de Administrador</title>
    <link rel="icon" href="images/favicon.png" type="image/png">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Open Sans', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
        }
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 70vh; /* Reduce la altura aquí */
            width: 100%; /* Aumenta el ancho aquí */
            border-radius: 20px;
            background: linear-gradient(145deg, #0099ff, #00ccff);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .login-card {
            display: flex;
            flex-direction: row;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
            width: 800px; /* Ajusta el ancho aquí */
            height: 400px; /* Ajusta la altura aquí */
        }
        .login-card .left-panel {
            background: url('images/login-background.png') no-repeat center center;
            background-size: cover;
            width: 400px;
        }
        .login-card .right-panel {
            padding: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 400px;
        }
        .login-card h2 {
            color: #0d47a1;
            font-weight: 700;
            text-align: center;
        }
        .form-group label {
            color: #0d47a1;
        }
        .form-control {
            background: #e3f2fd;
            border: none;
            color: #0d47a1;
        }
        .form-control:focus {
            background: #bbdefb;
        }
        .btn-primary {
            background: #0d47a1;
            border: none;
            padding: 10px 20px;
            margin-top: 10px;
            transition: background 0.3s;
        }
        .btn-primary:hover {
            background: #1565c0;
        }
        .alert {
            background: #b71c1c;
            color: #ffffff;
            border: none;
        }
        .login-card .right-panel .form-group .btn-link {
            color: #0d47a1;
        }
    </style>
    <script src="https://cdn.emailjs.com/dist/email.min.js"></script>
    <script>
        (function() {
            emailjs.init('CmcW5DX-iqKOIvhys'); // Reemplaza 'YOUR_PUBLIC_KEY' con tu clave pública de EmailJS
        })();
    </script>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="left-panel"></div>
            <div class="right-panel">
                <h2 class="text-center">Iniciar Sesión</h2>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <form action="login.php" method="post" class="needs-validation" novalidate>
                    <div class="form-group">
                        <label for="username">Nombre de Usuario:</label>
                        <input type="text" id="username" name="username" class="form-control" required>
                        <div class="invalid-feedback">Por favor, ingrese su nombre de usuario.</div>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                        <div class="invalid-feedback">Por favor, ingrese su contraseña.</div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
                </form>
                <a href="forgot_password.php" class="btn btn-link btn-block mt-3">¿Olvidaste tu contraseña?</a>
                <a href="index.php" class="btn btn-link btn-block mt-3">Regresar al Inicio</a>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrap.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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