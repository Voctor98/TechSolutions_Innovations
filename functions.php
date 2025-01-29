<?php
// functions.php

function check_permissions() {
    if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
        header("Location: access_denied.php");
        exit();
    }
}
?>
