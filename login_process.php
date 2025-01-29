<?php
session_start();
include 'techsolutions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta preparada para evitar SQL Injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND role='admin'");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result === false) {
        die("Error en la consulta SQL: " . $conn->error);
    }

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        // Verificar la contraseña usando password_verify
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = 'admin';
            // Regenerar el ID de sesión para mayor seguridad
            session_regenerate_id(true);
            header("Location: index.php");
            exit();
        } else {
            $error = "Usuario o contraseña incorrectos";
            header("Location: login.php?error=1");
            exit();
        }
    } else {
        $error = "Usuario o contraseña incorrectos";
        header("Location: login.php?error=1");
        exit();
    }
}
$conn->close();
?>
