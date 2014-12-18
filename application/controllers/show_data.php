<?php
    include_once '../config/db_connect.php';
    include_once '../models/company.php';
    mysql_query("SET NAMES utf8");
    
    if (isset ($_SESSION['id'])){
        $return = AutofillUpdateProfileForm ($_SESSION['id']);
        $_SESSION['comp_name'] = $return['comp_name'];
        $_SESSION['display_name_upd'] = $return['display_name'];
        $_SESSION['password'] = $return['password'];
        $_SESSION['address'] = $return['address'];
        $_SESSION['city'] = $return['city'];
        $_SESSION['postal_code'] = $return['postal_code'];
        $_SESSION['phone'] = $return['phone'];
        $_SESSION['email'] = $return['email'];
        $_SESSION['latitude'] = $return['latitude'];
        $_SESSION['longitude'] = $return['longitude'];
    }
?>

