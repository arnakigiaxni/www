<?php
    session_start();
    
    include_once '../config/db_connect.php';
    include_once '../models/company.php';
    mysql_query("SET NAMES utf8");
    
    $result = AutofillUpdateProfileForm($_SESSION['id']);
    $_SESSION['upd_comp_name'] = $result['comp_name'];
    $_SESSION['upd_display_name'] = $result['display_name']; 
    $_SESSION['upd_password'] = $result['password'];  
    $_SESSION['upd_email'] = $result['email'];  
    $_SESSION['upd_phone'] = $result['phone'];  
    $_SESSION['upd_address'] = $result['address'];  
    $_SESSION['upd_city'] = $result['city'];  
    $_SESSION['upd_postal_code'] = $result['postal_code'];  
    $_SESSION['upd_latitude'] = $result['latitude'];  
    $_SESSION['upd_longitude'] = $result['longitude']; 
    
    $_SESSION['comp_name'] = filter_input(INPUT_POST, 'comp_name');
    $_SESSION['display_name'] = filter_input(INPUT_POST, 'display_name');
    $_SESSION['password'] = filter_input(INPUT_POST, 'password');
    $_SESSION['email'] = filter_input(INPUT_POST, 'email');
    $_SESSION['phone'] = filter_input(INPUT_POST, 'phone');
    $_SESSION['city'] = filter_input(INPUT_POST, 'city');
    $_SESSION['address'] = filter_input(INPUT_POST, 'address');  
    $_SESSION['postal_code'] = filter_input(INPUT_POST, 'postal_code');
    $_SESSION['latitude'] = filter_input(INPUT_POST, 'latitude');
    $_SESSION['longitude'] = filter_input(INPUT_POST, 'longitude');    
    
    if (!preg_match("/^[a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_]*$/",$_SESSION['upd_comp_name'])) {
         $_SESSION['error_comp_name'] = "8 έως 20 χαρακτήρες ή αριθμούς και underscore"; 
         $_SESSION['update_profile_error'] = true;
    }    
    else if (empty ($_SESSION['upd_comp_name'])){
        $_SESSION['error_comp_name'] = "Απαιτείται όνομα χρήστη";
        $_SESSION['update_profile_error'] = true;
    }
    
    if (!preg_match("/^[a-zA-Z0-9\x80-\xFF\_][a-zA-Z0-9\x80-\xFF\_][a-zA-Z0-9\x80-\xFF\_][a-zA-Z0-9\x80-\xFF\_][a-zA-Z0-9\x80-\xFF\_][a-zA-Z0-9\x80-\xFF\_][a-zA-Z0-9\x80-\xFF\_][a-zA-Z0-9\x80-\xFF\_]*$/",$_SESSION['upd_password'])) {
         $_SESSION['error_password'] = "8 έως 20 χαρακτήρες ή αριθμούς και underscore"; 
         $_SESSION['update_profile_error'] = true;
    }   
    else if (empty ($_SESSION['upd_password'])){
        $_SESSION['error_password'] = "Απαιτείται κωδικός";
        $_SESSION['update_profile_error'] = true;
    }
    
   if (!preg_match("/^[a-zA-Z0-9\x80-\xFF ]*$/",$_SESSION['upd_display_name'])) {
         $_SESSION['error_display_name'] = "Μόνο χαρακτήρες, αριθμοί και κενά επιτρέπονται"; 
         $_SESSION['update_profile_error'] = true;
   }    
   else if (empty ($_SESSION['upd_display_name'])){
        $_SESSION['error_display_name'] = "Απαιτείται επωνυμία καταστήματος";
        $_SESSION['update_profile_error'] = true;
    }

   if (!filter_var($_SESSION['upd_email'], FILTER_VALIDATE_EMAIL)) {
         $_SESSION['error_email'] = "Λανθασμένη μορφή email"; 
         $_SESSION['update_profile_error'] = true;
   }
   else if (empty ($_SESSION['upd_email'])){
        $_SESSION['error_email'] = "Απαιτείται email";
        $_SESSION['update_profile_error'] = true;
   }
   
   if (!preg_match("/^[0-9]{10}$/",$_SESSION['upd_phone'])) {
         $_SESSION['error_phone'] = "Απαιτούνται ακριβώς 10 νούμερα"; 
         $_SESSION['update_profile_error'] = true;
   }    
   else if (empty ($_SESSION['upd_phone'])){
        $_SESSION['error_phone'] = "Απαιτείται τηλέφωνο";
        $_SESSION['update_profile_error'] = true;
    }  
    
    if (empty ($_SESSION['upd_city'])){
        $_SESSION['error_city'] = "Απαιτείται πόλη";
        $_SESSION['update_profile_error'] = true;
    }
    
    if (empty ($_SESSION['upd_address'])){
        $_SESSION['error_address'] = "Απαιτείται διεύθυνση";
        $_SESSION['update_profile_error'] = true;
    }
    
    if (empty ($_SESSION['upd_latitude'])){
        $_SESSION['error_latitude'] = "Απαιτείται γεωγραφικό πλάτος";
        $_SESSION['update_profile_error'] = true;
    }
    
    if (empty ($_SESSION['error_longitude'])){
        $_SESSION['error_longitude'] = "Απαιτείται γεωγραφικό μήκος";
        $_SESSION['update_profile_error'] = true;
    }
    
    if (!isset($_SESSION['update_profile_error'])) {
        $update_profile = UpdateProfile($_SESSION['upd_comp_name'] , $_SESSION['upd_display_name'] , 
            $_SESSION['upd_password'] , $_SESSION['upd_email'] , $_SESSION['upd_phone'] , $_SESSION['upd_city'] , 
            $_SESSION['upd_address'] , $_SESSION['upd_postal_code'] , $_SESSION['upd_latitude'] , 
            $_SESSION['upd_longitude'], $_SESSION['id']);
        $_SESSION['success'] = "Επιτυχής επεξεργασία!";
    }
    unset ($_SESSION['update_profile_error'] ); 
    header( 'Location: ../views/profile_update_view.php');