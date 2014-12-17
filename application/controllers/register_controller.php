<?php
    session_start();
    
    include '../config/db_connect.php';
    include '../models/company.php';
    
    $comp_name = filter_input(INPUT_POST, 'comp_name');
    $display_name = filter_input(INPUT_POST, 'display_name');
    $password = filter_input(INPUT_POST, 'password');
    $email = filter_input(INPUT_POST, 'email');
    $phone = filter_input(INPUT_POST, 'phone');
    $city = filter_input(INPUT_POST, 'city');
    $address = filter_input(INPUT_POST, 'address');  
    $postal_code = filter_input(INPUT_POST, 'postal_code');
    $latitude = filter_input(INPUT_POST, 'latitude');
    $longitude= filter_input(INPUT_POST, 'longitude');    
    
    
    if (!preg_match("/^[a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_]*$/",$comp_name)) {
         $_SESSION['error_comp_name'] = "8 έως 20 χαρακτήρες ή αριθμούς και underscore"; 
         $_SESSION['register_error'] = true;
    }    
    else if (empty ($comp_name)){
        $_SESSION['error_comp_name'] = "Απαιτείται όνομα χρήστη";
        $_SESSION['register_error'] = true;
    }
    
    if (!preg_match("/^[a-zA-Z0-9\x80-\xFF\_][a-zA-Z0-9\x80-\xFF\_][a-zA-Z0-9\x80-\xFF\_][a-zA-Z0-9\x80-\xFF\_][a-zA-Z0-9\x80-\xFF\_][a-zA-Z0-9\x80-\xFF\_][a-zA-Z0-9\x80-\xFF\_][a-zA-Z0-9\x80-\xFF\_]*$/",$password)) {
         $_SESSION['error_password'] = "8 έως 20 χαρακτήρες ή αριθμούς και underscore"; 
         $_SESSION['register_error'] = true;
    }   
    else if (empty ($password)){
        $_SESSION['error_password'] = "Απαιτείται κωδικός";
        $_SESSION['register_error'] = true;
    }
    
   if (!preg_match("/^[a-zA-Z0-9\x80-\xFF ]*$/",$display_name)) {
         $_SESSION['error_display_name'] = "Μόνο χαρακτήρες, αριθμοί και κενά επιτρέπονται"; 
         $_SESSION['register_error'] = true;
   }    
   else if (empty ($display_name)){
        $_SESSION['error_display_name'] = "Απαιτείται επωνυμία καταστήματος";
        $_SESSION['register_error'] = true;
    }

   if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $_SESSION['error_email'] = "Λανθασμένη μορφή email"; 
         $_SESSION['register_error'] = true;
   }
   else if (empty ($email)){
        $_SESSION['error_email'] = "Απαιτείται email";
        $_SESSION['register_error'] = true;
   }
   
   if (!preg_match("/^[0-9]{10}$/",$phone)) {
         $_SESSION['error_phone'] = "Απαιτούνται ακριβώς 10 νούμερα"; 
         $_SESSION['register_error'] = true;
   }    
   else if (empty ($phone)){
        $_SESSION['error_phone'] = "Απαιτείται τηλέφωνο";
        $_SESSION['register_error'] = true;
    }  
    
    if (empty ($city)){
        $_SESSION['error_city'] = "Απαιτείται πόλη";
        $_SESSION['register_error'] = true;
    }
    
    if (empty ($address)){
        $_SESSION['error_address'] = "Απαιτείται διεύθυνση";
        $_SESSION['register_error'] = true;
    }
    
    if (empty ($latitude)){
        $_SESSION['error_latitude'] = "Απαιτείται γεωγραφικό πλάτος";
        $_SESSION['register_error'] = true;
    }
    
    if (empty ($longitude)){
        $_SESSION['error_longitude'] = "Απαιτείται γεωγραφικό μήκος";
        $_SESSION['register_error'] = true;
    }
    
    if (!isset($_SESSION['register_error'])) {
        $new_company = AddCompany($comp_name, $display_name, $password, $email, $phone, $city, $address, $postal_code, $latitude, $longitude);
        $_SESSION['success'] = "Επιτυχής εγγραφή!";
    }
    unset ($_SESSION['register_error']);   
    header( 'Location: ../views/register.php');
