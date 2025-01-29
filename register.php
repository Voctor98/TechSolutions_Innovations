<?php
include 'techsolutions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Encriptar la contraseña usando password_hash
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Consulta preparada para evitar SQL Injection
    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'admin')");
    $stmt->bind_param("ss", $username, $hashed_password);

    if ($stmt->execute()) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Registro Exitoso',
                text: 'El usuario ha sido registrado correctamente.',
                onClose: () => {
                    window.location.href = 'login.php';
                }
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al registrar el usuario: " . $stmt->error . "'
            });
        </script>";
    }

    $stmt->close();
    $conn->close();
}
?>
