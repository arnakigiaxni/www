<?php
    include_once '../config/db_connect.php';
    include_once '../models/company.php';
    
    class ShowData {
        
        function show(){
            $result = AutofillUpdateProfileForm ($_SESSION['id']);
            return $result;
        }
    }
?>

