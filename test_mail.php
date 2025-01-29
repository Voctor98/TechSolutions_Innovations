<?php
require 'vendor/autoload.php'; // Asegúrate de que la ruta sea correcta

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
    $mail->setFrom('tu_correo@gmail.com', 'TechSolutions Innovations'); // Reemplaza con tu correo de Gmail
    $mail->addAddress('destinatario@example.com'); // Reemplaza con la dirección de correo del destinatario

    $mail->isHTML(true);
    $mail->Subject = 'Correo de prueba';
    $mail->Body    = 'Este es un correo de prueba enviado desde PHPMailer';

    $mail->send();
    echo 'El correo ha sido enviado con éxito';
} catch (Exception $e) {
    echo "Error al enviar el correo: {$mail->ErrorInfo}";
}
?>
