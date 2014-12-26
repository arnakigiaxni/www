<?php

    include_once '/../config/db_connect.php';
    include_once '/../models/company.php';
    mysql_query("SET NAMES utf8");
    
    class RegisterController { 
        
        function addCompany($comp_name, $display_name, $password, $email, $phone, $city, $address, $postal_code, 
                     $latitude, $longitude) {
            
            $code = new RegisterController();
            
            $code_comp_name = $code->compName($comp_name);
            $code_display_name = $code->displayName($display_name);
            $code_password = $code->password($password);
            $code_email = $code->email($email);
            $code_phone = $code->phone($phone);
            $code_city = $code->city($city);
            $code_address = $code->address($address);
            $code_postal_code = $code->postalCode($postal_code);
            $code_latitude = $code->latitude($latitude);
            $code_longitude = $code->longitude($longitude);
            
            $error_codes = array($code_comp_name, $code_display_name, $code_password, $code_email, $code_phone, 
                $code_city, $code_address, $code_postal_code, $code_latitude, $code_longitude);
            
            if ($code_comp_name == 0 && $code_display_name == 0 && $code_password == 0 && $code_email == 0 &&
                $code_phone == 0 && $code_city == 0 && $code_address == 0 && $code_postal_code == 0 && 
                $code_latitude == 0 && $code_longitude == 0) {
                
                $new_company = AddCompany($comp_name, $display_name, $password, $email, $phone, $city, $address, 
                    $postal_code, $latitude, $longitude);
            
                if ($new_company != false){
                    $result = array("1");
                    return $result;
                }
                else{
                    return $error_codes;
                }
            } else {
                return $error_codes;
              }
        }
    
        
        function compName ($comp_name){
            $comp_exists = RegisterCompNameExists($comp_name);
            if (empty($comp_name)) {
                $errorCode = -1;
            } else if (!preg_match("/^[a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_]*$/",$comp_name)) {
                $errorCode = -2;
            } else if ($comp_exists == TRUE){
                $errorCode = -3;
            }
            else {
                $errorCode = 0;
            }
            return $errorCode;
        }
        
        function displayName ($display_name){
            if (empty($display_name)) {
                $errorCode = -4;
            } else if (!preg_match("/^[a-zA-Z0-9\x80-\xFF ]*$/",$display_name)) {
                $errorCode = -5;
            } else {
                $errorCode = 0;
            }
            return $errorCode;
        }        
        
        function password ($password){
            if (empty($password)) {
                $errorCode = -6;
            } else if (!preg_match("/^[a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_][a-zA-Z0-9\x80-\xFF_]*$/",$password)) {
                $errorCode = -7;
            } else {
                $errorCode = 0;
            }
            return $errorCode;
        }      
        
        function email ($email){
            $email_exists = RegisterEmailExists($email);
            if (empty($email)) {
                $errorCode = -8;
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errorCode = -9;
            } else if ($email_exists == TRUE){
                $errorCode = -10;
            }
            else {
                $errorCode = 0;
            }
            return $errorCode;
        }        
        
        function phone ($phone){
            $phone_exists = RegisterPhoneExists($phone);
            if (empty($phone)) {
                $errorCode = -11;
            } else if (!preg_match("/^[0-9]{10}$/",$phone)) {
                $errorCode = -12;
            } else if ($phone_exists == TRUE){
                $errorCode = -13;
            }
            else {
                $errorCode = 0;
            }
            return $errorCode;
        }        
        
        function city ($city){
            if (empty($city)) {
                $errorCode = -14;
            } else {
                $errorCode = 0;
            }
            return $errorCode;
        }      
        
        function address ($address){
            if (empty($address)) {
                $errorCode = -15;
            } else {
                $errorCode = 0;
            }
            return $errorCode;
        }    
        
        function postalCode ($postal_code){
            $errorCode = 0;
            return $errorCode;
        }     
        
        function latitude ($latitude){
            if (empty($latitude)) {
                $errorCode = -16;
            } else {
                $errorCode = 0;
            }
            return $errorCode;
        }        
        
        function longitude ($longitude){
            if (empty($longitude)) {
                $errorCode = -17;
            } else {
                $errorCode = 0;
            }
            return $errorCode;
        }        
    
    }
