<?php
    session_start();
    unset($_SESSION['comp_name']);
    unset($_SESSION['comp_id']);
    header("Location: ../views/index.php");
?>

