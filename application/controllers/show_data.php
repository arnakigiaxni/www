<?php
    include_once '../config/db_connect.php';
    include_once '../models/company.php';
    mysql_query("SET NAMES utf8");
    
    class ShowData {
        
        function show(){
            $result = AutofillUpdateProfileForm ($_SESSION['id']);
            return $result;
        }
    }
?>

