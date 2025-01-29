<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "techsolutions";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Recibir datos
$username = $_POST['username'];
$message = $_POST['message'];

// Insertar mensaje en la base de datos
$sql = "INSERT INTO messages (username, message) VALUES ('$username', '$message')";
$conn->query($sql);

$conn->close();
?>
