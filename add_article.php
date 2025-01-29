<?php
include 'techsolutions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $sql = "INSERT INTO articles (name, description, price) VALUES ('$name', '$description', '$price')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Nuevo artículo agregado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Artículo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Agregar Nuevo Artículo</h1>
    <form method="POST" action="">
        <label for="name">Nombre:</label><br>
        <input type="text" id="name" name="name" required><br>
        <label for="description">Descripción:</label><br>
        <textarea id="description" name="description" required></textarea><br>
        <label for="price">Precio:</label><br>
        <input type="number" id="price" name="price" step="0.01" required><br>
        <input type="submit" value="Agregar">
    </form>
    <a href="index.php">Volver a la lista de artículos</a>
</body>
</html>
