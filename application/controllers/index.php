<?php
    session_start();
    include_once '../config/db_connect.php';
    include_once '../views/header.php';
    include_once '../views/menu.php';
    
    if (isset($_SESSION['id'])) {
        include_once '../views/home.php';
    } 
    else {
        include_once '../views/login.php';
    }
    include_once '../views/footer.php';
?>
