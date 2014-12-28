<?php
    include_once '/../config/db_connect.php';
    include_once '/../models/company.php';
    session_start();
    mysql_query("SET NAMES utf8");
     
    class ProfileUpdateController {
    
        function profileUpdate($comp_name, $display_name, $password, $email, $phone, 
                $city, $address, $postal_code, $latitude, $longitude){
            $code = new ProfileUpdateController();  
                
            $code_comp = $code->compName($comp_name);
            $code_display = $code->displayName($display_name);
            $code_password = $code->password($password);
            $code_email = $code->email($email);
            $code_phone = $code->phone($phone);
            $code_city = $code->city($city);
            $code_address = $code->address($address);
            $code_postal = $code->postalCode($postal_code);
            $code_latitude = $code->latitude($latitude);
            $code_longitude = $code->longitude($longitude);  
            $error_codes = array($code_comp, $code_display, $code_password, $code_email,
                $code_phone, $code_city, $code_address, $code_postal, $code_latitude, $code_longitude);
                
            if ($code_comp == 0 && $code_display == 0 && $code_password == 0
                    && $code_email == 0 && $code_phone == 0 && $code_city == 0
                    && $code_address == 0 && $code_postal == 0 && $code_latitude == 0
                    && $code_longitude == 0){
                $update = UpdateProfile($comp_name, $display_name, $password, 
                        $email, $phone, $city, $address, $postal_code, $latitude, 
                        $longitude, $_SESSION['id']);
                $result = array("1");
                return $result;
            }
            else {
                return $error_codes;
            }
        }
        
        function compName($comp_name){
            $exists = UpdateCompNameExists($comp_name, $_SESSION['id']);
            if ($exists != false){
                $error_code = -1;
            }
            else if (empty ($comp_name)){
                $error_code = -2;
            }    
            else if (!preg_match("/^[a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_]*$/",$comp_name)) {
                $error_code = -3;
            }
            else {
                $error_code = 0;
            }
            return $error_code;
        }
        
        function displayName($display_name){
            if (empty ($display_name)){
                $error_code = -4;
            }
            else if (!preg_match("/^[a-zA-Z0-9\x80-\xFF ]*$/",$display_name)) {
                $error_code = -5;
            }
            else {
                $error_code = 0;
            }
            return $error_code;
        }
        
        function password($password) {
            if (empty ($password)){
                $error_code = -6;
            }    
            else if (!preg_match("/^[a-zA-Z0-9\x80-\xFF\_][a-zA-Z0-9\x80-\xFF\_][a-zA-Z0-9\x80-\xFF\_][a-zA-Z0-9\x80-\xFF\_][a-zA-Z0-9\x80-\xFF\_][a-zA-Z0-9\x80-\xFF\_][a-zA-Z0-9\x80-\xFF\_][a-zA-Z0-9\x80-\xFF\_]*$/",$password)) {
                $error_code = -7;
            }   
            else {
                $error_code = 0;
            }
            return $error_code;
        }
        
        function email($email){
            $exists = UpdateEmailExists($email, $_SESSION['id']);
            if ($exists != false){
                $error_code = -8;
            }
            else if (empty ($email)){
                $error_code = -9;
            }    
            else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error_code = -10;
            }
            else {
                $error_code = 0;
            }
            return $error_code;
        }
        
        function phone($phone){
            $exists = UpdatePhoneExists($phone, $_SESSION['id']);
            if ($exists != false){
                $error_code = -11;
            }
            else if (empty ($phone)){
                $error_code = -12;
            }   
            else if (!preg_match("/^[0-9]{10}$/",$phone)) {
                $error_code = -13;
            }    
            else {
                $error_code = 0;
            }
            return $error_code;
        }
        
        function city($city){
            if (empty ($city)){
                $error_code = -14;
            }
            else {
                $error_code = 0;
            }
            return $error_code;
        }   
       
        function address($address){
            if (empty ($address)){
                $error_code = -15;
            }
            else {
                $error_code = 0;
            }
            return $error_code;
        }
        
        function postalCode ($postal_code){
            if (empty ($postal_code)){
                $error_code = -16;
            }
            else {
                $error_code = 0;
            }
            return $error_code;
        }
        
        function latitude ($latitude){
            if (empty ($latitude)){
                $error_code = -17;
            }
            else {
                $error_code = 0;
            }
            return $error_code;
        }
        
        function longitude($longitude){
            if (empty ($longitude)){
                $error_code = -18;
            }
            else {
                $error_code = 0;
            }
            return $error_code;
        }
    }