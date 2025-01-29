<?php
session_start();
require 'vendor/autoload.php'; // Asegúrate de que la ruta sea correcta
include 'techsolutions.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Verificar si el correo electrónico está registrado
    $sql = "SELECT * FROM users WHERE email='$email' AND role='admin'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $token = bin2hex(random_bytes(50));
        $sql = "UPDATE users SET reset_token='$token', reset_token_expiry=DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email='$email'";
        if ($conn->query($sql) === TRUE) {
            $reset_link = "http://localhost/TechSolutions_Innovations/reset_password.php?token=$token"; // Asegúrate de que la ruta sea correcta

            $mail = new PHPMailer(true);
            try {
                // Configuración del servidor SMTP
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'victormendozapalacio@gmail.com'; // Reemplaza con tu correo de Gmail
                $mail->Password = 'lpuo rehj gypp khfv'; // Reemplaza con tu contraseña de aplicación de Gmail
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                // Configuración del correo
                $mail->setFrom('victormendozapalacio@gmail.com', 'TechSolutions Innovations'); // Reemplaza con tu correo de Gmail
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = 'Recuperación de Contraseña';
                $mail->Body    = "Haga clic en el siguiente enlace para restablecer su contraseña: <a href='$reset_link'>$reset_link</a>";

                $mail->send();
                header("Location: forgot_password.php?success=1");
                exit();
            } catch (Exception $e) {
                // Mostrar errores detallados de PHPMailer
                echo "Error al enviar el correo: {$mail->ErrorInfo}";
            }
        } else {
            header("Location: forgot_password.php?error=1");
            exit();
        }
    } else {
        header("Location: forgot_password.php?error=1");
        exit();
    }
}
?>
