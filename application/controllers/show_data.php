<?php
    include_once '../config/db_connect.php';
    include_once '../models/company.php';
    mysql_query("SET NAMES utf8");
    
    if (isset ($_SESSION['id'])){
        $result = AutofillUpdateProfileForm ($_SESSION['id']);
        $_SESSION['comp_name'] = $result['comp_name'];
        $_SESSION['display_name_upd'] = $result['display_name'];
        $_SESSION['password'] = $result['password'];
        $_SESSION['address'] = $result['address'];
        $_SESSION['city'] = $result['city'];
        $_SESSION['postal_code'] = $result['postal_code'];
        $_SESSION['phone'] = $result['phone'];
        $_SESSION['email'] = $result['email'];
        $_SESSION['latitude'] = $result['latitude'];
        $_SESSION['longitude'] = $result['longitude'];
    }
?>

