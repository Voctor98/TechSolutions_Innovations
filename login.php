<?php
session_start();
include 'techsolutions.php';

// --- TU LÓGICA ORIGINAL COMPLETAMENTE INTACTA ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if ($user['is_locked']) {
            $lock_time = strtotime($user['lock_time']);
            $current_time = time();
            $lock_duration = 2 * 60; 

            if ($current_time - $lock_time > $lock_duration) {
                $stmt = $conn->prepare("UPDATE users SET failed_attempts = 0, is_locked = 0, lock_time = NULL WHERE username=?");
                $stmt->bind_param("s", $username);
                $stmt->execute();
            } else {
                $error = "Tu cuenta está bloqueada. Inténtalo de nuevo en " . (2 - floor(($current_time - $lock_time) / 60)) . " minutos.";
            }
        } elseif (password_verify($password, $user['password']) && $user['role'] == 'admin') {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = 'admin';
            $stmt = $conn->prepare("UPDATE users SET failed_attempts = 0, is_locked = 0, lock_time = NULL WHERE username=?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            header("Location: index.php");
            exit();
        } else {
            $stmt = $conn->prepare("UPDATE users SET failed_attempts = failed_attempts + 1 WHERE username=?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $user['failed_attempts'] += 1;

            if ($user['failed_attempts'] >= 3) {
                $stmt = $conn->prepare("UPDATE users SET is_locked = 1, lock_time = NOW() WHERE username=?");
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $error = "Tu cuenta ha sido bloqueada debido a múltiples intentos fallidos de inicio de sesión.";
            } else {
                // AQUÍ ESTÁ EL MENSAJE QUE NECESITAS CON EL CONTADOR
                $error = "Usuario o contraseña incorrectos. Intentos fallidos: " . $user['failed_attempts'];
            }
        }
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso Admin | TechSolutions</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #0062E6 0%, #33AEFF 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Roboto', sans-serif;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            width: 420px;
            padding: 40px;
            text-align: center;
        }
        .brand-logo { max-width: 120px; margin-bottom: 20px; }
        .glass-card h2 { color: #0d47a1; font-weight: 800; font-size: 1.5rem; margin-bottom: 25px; }
        .form-control { border-radius: 10px; padding: 12px; border: 1px solid #ddd; }
        .btn-primary { background: #0d47a1; border: none; border-radius: 10px; padding: 12px; font-weight: 600; transition: 0.3s; }
        .btn-primary:hover { background: #082d6a; transform: translateY(-2px); }
        /* Estilo para el mensaje de error original */
        .alert { border-radius: 10px; font-size: 0.9rem; background: #b71c1c; color: #ffffff; border: none; }
    </style>
</head>
<body>

<div class="glass-card">
    <img src="images/favicon.png" alt="TechSolutions Logo" class="brand-logo">
    <h2>Acceso Administrador</h2>
    
    <!-- Se muestra el mensaje de error con el contador dinámico si existe -->
    <?php if (isset($error)): ?>
        <div class="alert alert-danger mb-3"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <form action="login.php" method="post">
        <div class="form-group text-left">
            <label class="small font-weight-bold">Usuario</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="form-group text-left">
            <label class="small font-weight-bold">Contraseña</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block mt-4">INGRESAR</button>
    </form>
    
    <div class="mt-4">
        <a href="forgot_password.php" class="text-secondary small d-block">¿Olvidaste tu contraseña?</a>
        <a href="index.php" class="text-secondary small d-block mt-2">← Regresar al sitio</a>
    </div>
</div>

</body>
</html>