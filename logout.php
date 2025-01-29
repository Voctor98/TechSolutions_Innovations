<?php
session_start();

if (isset($_SESSION['username'])) {
    // Registrar el evento de logout
    $log_message = date('Y-m-d H:i:s') . " - " . $_SESSION['username'] . " - Logout\n";
    file_put_contents('login_logout.log', $log_message, FILE_APPEND);

    session_unset();
    session_destroy();
}

header('Location: login.php');
exit();
?>