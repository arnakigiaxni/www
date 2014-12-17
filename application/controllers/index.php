<?php
    session_start();
    include '../config/db_connect.php';
    include '../views/header.php';
    include '../views/menu.php';
    if (isset($_SESSION['id'])) {
        include '../views/home.php';
    } 
    else {
        include '../views/login.php';
    }
    include '../views/footer.php';
?>
