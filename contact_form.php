<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Aquí puedes procesar el formulario, por ejemplo, enviando un correo electrónico
    // mail($to, $subject, $message, $headers);

    // Redirigir a la página de contacto con un mensaje de éxito
    header("Location: contact.php?success=1");
    exit();
}
?>
