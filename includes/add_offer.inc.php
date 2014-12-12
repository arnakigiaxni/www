<?php

    include_once "db_connect.php";
    include_once "functions.php";
    mysql_query("SET NAMES utf8");
    
    $offer_name = $offer_descr = $start_date = $end_date = $discount = $price = "";
    $offer_nameError = $offer_descrError = $start_dateError = $end_dateError = $discountError = $priceError = "";
    $successful_add = "";
    $cat_id = 1;
    
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            if (empty($_POST["offer_name"])) {
                $offer_nameError = "Απαιτείται όνομα προσφοράς";
            } 
            else {
                $offer_name = test_input($_POST["offer_name"]);
                    if (!preg_match("/^[a-zA-Z0-9\x80-\xFF\!\%\&\-\+ ]*$/",$offer_name)) {
                        $offer_nameError = "Μόνο χαρακτήρες, αριθμοί και κενά επιτρέπονται"; 
                    }
            }
            
            $offer_descr = test_input($_POST["offer_descr"]);
            if ($offer_descr==NULL) {
                $offer_descr = "";
            } 
            else {
                    if (!preg_match("/^[a-zA-Z0-9\x80-\xFF\!\%\&\-\+ ]*$/",$offer_descr)) {
                        $offer_descrError = "Μόνο χαρακτήρες, αριθμοί και κενά επιτρέπονται"; 
                    }
            }      
            
            $cat_id = $_POST["cat_id"];      
            
            if (empty($_POST["start_date"])) {
                $start_dateError = "Απαιτείται ημερομηνία έναρξης";
            }             
            else {
                $start_date = $_POST["start_date"];
            }
            
            if (empty($_POST["end_date"])) {
                $end_dateError = "Απαιτείται ημερομηνία λήξης";
            }             
            else {
                $end_date = $_POST["end_date"];
            }  
            
            if (empty($_POST["discount"])) {
                $discountError = "Απαιτείται ποσοστό προσφοράς";
            } 
            else if($_POST["discount"] > 100){
                $discountError = "Δεν μπορείτε να έχετε έκπτωση πάνω απο 100%";
            }
            else {
                $discount = test_input($_POST["discount"]);
                    if (!preg_match("/^[0-9.]*$/",$discount)) {
                        $discountError = "Μόνο αριθμοί και η διαχωριστική . επιτρέπονται"; 
                    }
            }    
            
            if (empty($_POST["price"])) {
                $priceError = "Απαιτείται τιμή";
            } 
            else {
                $price = test_input($_POST["price"]);
                    if (!preg_match("/^[0-9.]*$/",$price)) {
                        $priceError = "Μόνο αριθμοί και η διαχωριστική . επιτρέπονται"; 
                    }
            }           
            
            session_start();
            if(isset($_SESSION["comp_id"])) {
                $comp_id = $_SESSION["comp_id"];
            }
            
            
            if ($offer_name!=NULL && $start_date!=NULL && $end_date!=NULL && $discount!=NULL && $price!=NULL
                && $offer_nameError==NULL && $offer_descrError==NULL && $start_dateError==NULL && $end_dateError==NULL &&
                    $discountError==NULL && $priceError==NULL){
                
                mysql_query("INSERT INTO offer (offer_name, comp_id, cat_id, offer_descr, start_date, end_date, discount, price)
                    VALUES ('".$offer_name."', '".$comp_id."', '".$cat_id."', '".$offer_descr."', '".$start_date."', '".$end_date."', '".$discount."', '".$price."')");
                
                if (mysql_affected_rows()==1){
                    $cat_id = 1;
                    $offer_name = $offer_descr  = $start_date = $end_date = $discount = $price = "";
                    $successful_add = "Επιτυχής καταχώρηση";
               }
            }
        }
        
                     