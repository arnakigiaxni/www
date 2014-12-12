<?php

    include_once "db_connect.php";
    include_once "functions.php";
    include_once "../views/update_profile.php";
    error_reporting(0);
    mysql_query("SET NAMES utf8");
    
    $comp_name = $password = $display_name = $email = $city = $address = $postal_code = $phone = $latitude = $longitude = "";
    $comp_nameError = $passwordError = $display_nameError = $emailError = $cityError = $addressError = $postal_codeError = $phoneError = $latitudeError = $longitudeError = "";    
    $successful_update = "";
    
    session_start();
    if(isset($_SESSION["comp_id"])) {
        $id = $_SESSION["comp_id"];
    }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                 if (empty($_POST["comp_name"])) {
                    $comp_nameError = "Απαιτείται όνομα χρήστη";
                 } 
                 else {
                    $comp_name = test_input($_POST["comp_name"]);
                    
                    $query = "SELECT * FROM company WHERE comp_name='$comp_name' AND id!='$id'";
                    $result = mysql_query($query) or die(mysql_error());
                    while($row=mysql_fetch_array($result)) {
                        $comp_name_exists = $row['comp_name'];
                        if($comp_name_exists==$comp_name){ 
                            $comp_nameError = "Το όνομα χρήστη που πληκτρολογήσατε υπάρχει ήδη";
                        }
                    }
                        if (!preg_match("/^[a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_]*$/",$comp_name)) {
                            $comp_nameError = "8 έως 20 χαρακτήρες ή αριθμούς (χωρίς κενά & ειδικούς χαρακτήρες, εκτός απ' το underscore)"; 
                            
                        }
                 }
                 
                 
                 if (empty($_POST["password"])) {
                    $passwordError = "Απαιτείται κωδικός";
                 } 
                 else {
                    $password = test_input($_POST["password"]);
                        if (!preg_match("/^[a-zA-Z0-9\x80-\xFF\_][a-zA-Z0-9\x80-\xFF\_][a-zA-Z0-9\x80-\xFF\_][a-zA-Z0-9\x80-\xFF\_][a-zA-Z0-9\x80-\xFF\_][a-zA-Z0-9\x80-\xFF\_][a-zA-Z0-9\x80-\xFF\_][a-zA-Z0-9\x80-\xFF\_]*$/",$password)) {
                            $passwordError = "8 έως 20 χαρακτήρες ή αριθμούς (χωρίς κενά & ειδικούς χαρακτήρες, εκτός απ' το underscore)"; 
                        }
                 }    
                 
                 
                 if (empty($_POST["display_name"])) {
                    $display_nameError = "Απαιτείται επωνυμία καταστήματος";
                 } 
                 else {
                    $display_name = test_input($_POST["display_name"]);
                        if (!preg_match("/^[a-zA-Z0-9\x80-\xFF ]*$/",$display_name)) {
                            $display_nameError = "Μόνο χαρακτήρες, αριθμοί και κενά επιτρέπονται"; 
                        }
                 }                 
                 
                 
                if (empty($_POST["email"])) {
                    $emailError = "Απαιτείται το e-mail";
                } 
                else {
                    $email = test_input($_POST["email"]);
                    
                    $query = "SELECT * FROM company WHERE email='$email' AND id!='$id'";
                    $result = mysql_query($query) or die(mysql_error());
                    while($row=mysql_fetch_array($result)) {
                        $email_exists = $row['email'];
                        if($email_exists==$email){ 
                            $emailError = "Το email που πληκτρολογήσατε υπάρχει ήδη";
                        }
                    }                    
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $emailError = "Λανθασμένη μορφή email"; 
                        }
                }
                
                 if (empty($_POST["city"])) {
                    $cityError = "Απαιτείται πόλη";
                 } 
                 else {
                    $city = test_input($_POST["city"]);
                        if (!preg_match("/^[a-zA-Z\x80-\xFF ]*$/",$city)) {
                            $cityError = "Μόνο χαρακτήρες και κενά επιτρέπονται"; 
                        }
                 }
                 
                 if (empty($_POST["address"])) {
                    $addressError = "Απαιτείται διεύθυνση";
                 } 
                 else {
                    $address = test_input($_POST["address"]);
                        if (!preg_match("/^[a-zA-Z0-9\x80-\xFF -]*$/",$address)) {
                            $addressError = "Μόνο χαρακτήρες, αριθμοί και κενά επιτρέπονται"; 
                        }
                 }
                 
                 $postal_code = test_input($_POST["postal_code"]);
                 if($postal_code==NULL){
                    $postal_code="";
                 }
                 else {
                        if (!preg_match("/^[0-9][0-9][0-9][ ][0-9][0-9]/",$postal_code)) {
                            $postal_codeError = "Σωστή μορφή ΤΚ: xxx xx"; 
                        }
                }
                 
                 if (empty($_POST["phone"])) {
                    $phoneError = "Απαιτείται τηλέφωνο";
                 } 
                 else {
                    $phone = test_input($_POST["phone"]);
                    
                    $query = "SELECT * FROM company WHERE phone='$phone' AND id!='$id'";
                    $result = mysql_query($query) or die(mysql_error());
                    while($row=mysql_fetch_array($result)) {
                        $phone_exists = $row['phone'];
                        if($phone_exists==$phone){ 
                            $phoneError = "Το τηλέφωνο που πληκτρολογήσατε υπάρχει ήδη";
                        }
                    } 
                        if (!preg_match("/^[0-9]{10}$/",$phone)) {
                            $phoneError = "Απαιτούνται ακριβώς 10 νούμερα"; 
                        }
                 } 
                 
                 if (empty($_POST["latitude"])) {
                    $latitudeError = "Απαιτείται γεωγραφικό πλάτος";
                 } 
                 else {
                    $latitude = test_input($_POST["latitude"]);
                 }
                 
                 if (empty($_POST["longitude"])) {
                    $longitudeError = "Απαιτείται γεωγραφικό μήκος";
                 } 
                 else {
                    $longitude = test_input($_POST["longitude"]);
                 }
                 
                 
                 if($comp_name!=NULL && $password!=NULL && $display_name!=NULL && $email!=NULL && $city!=NULL && $address!=NULL 
                        && $phone!=NULL && $latitude!=NULL && $longitude!=NULL &&
                        $emailError==NULL && $comp_nameError==NULL && $passwordError==NULL && $display_nameError==NULL && 
                        $cityError==NULL && $addressError==NULL && $postal_codeError==NULL && $phoneError==NULL && $latitudeError==NULL && $longitudeError==NULL){
                    
                        mysql_query("UPDATE company SET comp_name='".$comp_name."', password='".$password."', display_name='".$display_name."', email='".$email."', city='".$city."', 
                               address='".$address."', postal_code='".$postal_code."', phone='".$phone."', latitude='".$latitude."', longitude='".$longitude."' WHERE id=$id");
                        
                      if (mysql_affected_rows()==1){
                            session_start();
                            $_SESSION['comp_name'] = $comp_name;
                           // header( "Location: menu.php" );
                            
                            $successful_update = "Επιτυχής ενημέρωση";
                      }
                }                
            }
