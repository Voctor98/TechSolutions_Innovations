<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

include 'techsolutions.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT image FROM articles WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $image_path = "images/" . $row['image'];
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }

    $sql = "DELETE FROM articles WHERE id='$id'";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: products.php?delete_success=1");
    } else {
        header("Location: products.php?delete_error=1");
    }

    $conn->close();
} else {
    header("Location: products.php");
    exit();
}
?>
