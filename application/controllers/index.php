<?php
    session_start();
    include '../config/db_connect.php';
    if (isset($_SESSION['id'])) {
        include '../views/menu.php';
        include '../views/home.php';
    } 
    else {
        include '../views/login.php';
    }
    include '../views/footer.php';
?>
