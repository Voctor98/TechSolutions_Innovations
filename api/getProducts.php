<?php
include '../techsolutions.php'; // Conexión a la base de datos

// Consulta a la base de datos
$sql = "SELECT id, name, description, price, category, brand, image FROM articles"; 
$result = $conn->query($sql);

// Verificamos si hay productos
if ($result->num_rows > 0) {
    echo '<div style="display: flex; flex-wrap: wrap; gap: 20px;">';
    while ($row = $result->fetch_assoc()) {
        // Generamos el HTML para cada card
        echo '<div style="border: 1px solid #ddd; padding: 10px; width: 250px; text-align: center;">';
        echo '<img src="images/' . $row['image'] . '" alt="' . $row['name'] . '" width="100%" style="max-height: 150px; object-fit: cover;" />';
        echo '<h3>' . $row['name'] . '</h3>';
        echo '<p><strong>Categoría:</strong> ' . $row['category'] . '</p>';
        echo '<p><strong>Marca:</strong> ' . $row['brand'] . '</p>';
        echo '<p><strong>Precio:</strong> $' . $row['price'] . '</p>';
        echo '<p>' . $row['description'] . '</p>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo 'No se encontraron productos.';
}

$conn->close();
?>
