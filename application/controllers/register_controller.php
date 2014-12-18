<?php
    session_start();
    
    include_once '../config/db_connect.php';
    include_once '../models/company.php';
    mysql_query("SET NAMES utf8");
    
    $_SESSION['reg_comp_name'] = filter_input(INPUT_POST, 'comp_name');
    $_SESSION['reg_display_name'] = filter_input(INPUT_POST, 'display_name');
    $_SESSION['reg_password'] = filter_input(INPUT_POST, 'password');
    $_SESSION['reg_email'] = filter_input(INPUT_POST, 'email');
    $_SESSION['reg_phone'] = filter_input(INPUT_POST, 'phone');
    $_SESSION['reg_city'] = filter_input(INPUT_POST, 'city');
    $_SESSION['reg_address'] = filter_input(INPUT_POST, 'address');  
    $_SESSION['reg_postal_code'] = filter_input(INPUT_POST, 'postal_code');
    $_SESSION['reg_latitude'] = filter_input(INPUT_POST, 'latitude');
    $_SESSION['reg_longitude'] = filter_input(INPUT_POST, 'longitude');  
    
    
    if (empty ($_SESSION['reg_comp_name'])){
        $_SESSION['error_comp_name'] = "Απαιτείται όνομα χρήστη";
        $_SESSION['register_error'] = true;
    }    
    else if (!preg_match("/^[a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_]*$/",$_SESSION['reg_comp_name'])) {
         $_SESSION['error_comp_name'] = "8 έως 20 χαρακτήρες ή αριθμούς και underscore"; 
         $_SESSION['register_error'] = true;
    }    
    
    $comp_exists = RegisterCompNameExists($_SESSION['reg_comp_name']);
    if ($comp_exists == TRUE){
        $_SESSION['error_comp_name'] = "Το όνομα χρήστη υπάρχει ήδη";
        $_SESSION['register_error'] = true;
    }
   
    if (empty ($_SESSION['reg_password'])){
        $_SESSION['error_password'] = "Απαιτείται κωδικός";
        $_SESSION['register_error'] = true;
    }    
    else if (!preg_match("/^[a-zA-Z0-9\x80-\xFF\_][a-zA-Z0-9\x80-\xFF\_][a-zA-Z0-9\x80-\xFF\_][a-zA-Z0-9\x80-\xFF\_][a-zA-Z0-9\x80-\xFF\_][a-zA-Z0-9\x80-\xFF\_][a-zA-Z0-9\x80-\xFF\_][a-zA-Z0-9\x80-\xFF\_]*$/",$_SESSION['reg_password'])) {
         $_SESSION['error_password'] = "8 έως 20 χαρακτήρες ή αριθμούς και underscore"; 
         $_SESSION['register_error'] = true;
    }   
  
   if (!preg_match("/^[a-zA-Z0-9\x80-\xFF ]*$/",$_SESSION['reg_display_name'])) {
         $_SESSION['error_display_name'] = "Μόνο χαρακτήρες, αριθμοί και κενά επιτρέπονται"; 
         $_SESSION['register_error'] = true;
   }    
   else if (empty ($_SESSION['reg_display_name'])){
        $_SESSION['error_display_name'] = "Απαιτείται επωνυμία καταστήματος";
        $_SESSION['register_error'] = true;
    }

   if (empty ($_SESSION['reg_email'])){
        $_SESSION['error_email'] = "Απαιτείται email";
        $_SESSION['register_error'] = true;
   }    
   else if (!filter_var($_SESSION['reg_email'], FILTER_VALIDATE_EMAIL)) {
         $_SESSION['error_email'] = "Λανθασμένη μορφή email"; 
         $_SESSION['register_error'] = true;
   }

    $email_exists = RegisterEmailExists($_SESSION['reg_email']);
    if ($email_exists == TRUE){
        $_SESSION['error_email'] = "Το email υπάρχει ήδη";
        $_SESSION['register_error'] = true;
    }   

   if (empty ($_SESSION['reg_phone'])){
        $_SESSION['error_phone'] = "Απαιτείται τηλέφωνο";
        $_SESSION['register_error'] = true;
   }   
   else if (!preg_match("/^[0-9]{10}$/",$_SESSION['reg_phone'])) {
         $_SESSION['error_phone'] = "Απαιτούνται ακριβώς 10 νούμερα"; 
         $_SESSION['register_error'] = true;
   }    
   
    $phone_exists = RegisterPhoneExists($_SESSION['reg_phone']);
    if ($phone_exists == TRUE){
        $_SESSION['error_phone'] = "Το τηλέφωνο υπάρχει ήδη";
        $_SESSION['register_error'] = true;
    }    
      
    if (empty ($_SESSION['reg_city'])){
        $_SESSION['error_city'] = "Απαιτείται πόλη";
        $_SESSION['register_error'] = true;
    }
    
    if (empty ($_SESSION['reg_address'])){
        $_SESSION['error_address'] = "Απαιτείται διεύθυνση";
        $_SESSION['register_error'] = true;
    }
    
    if (empty ($_SESSION['reg_latitude'])){
        $_SESSION['error_latitude'] = "Απαιτείται γεωγραφικό πλάτος";
        $_SESSION['register_error'] = true;
    }
    
    if (empty ($_SESSION['reg_longitude'])){
        $_SESSION['error_longitude'] = "Απαιτείται γεωγραφικό μήκος";
        $_SESSION['register_error'] = true;
    }
    
    if (!isset($_SESSION['register_error'])) {
        $new_company = AddCompany($_SESSION['reg_comp_name'], $_SESSION['reg_display_name'], $_SESSION['reg_password'],
                                  $_SESSION['reg_email'], $_SESSION['reg_phone'], $_SESSION['reg_city'], $_SESSION['reg_address'],  
                                  $_SESSION['reg_postal_code'], $_SESSION['reg_latitude'], $_SESSION['reg_longitude']);
        $_SESSION['success'] = "Επιτυχής εγγραφή!";
    }
    unset ($_SESSION['register_error']);   
    header( 'Location: ../views/register.php');
