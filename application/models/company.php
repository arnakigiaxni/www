<?php
    function AuthenticateUser($username, $password){
        $result = mysql_query(
                "SELECT
                    id, display_name
                 FROM
                    company
                 WHERE
                    comp_name = '$username'
                    AND password = '$password'"
        );
        
        if (mysql_num_rows($result) == 1 ) {
            $userid = mysql_fetch_array($result);
            return $userid;
        }
        else {
            return false;
        }
    }
    
    function AddCompany ($comp_name, $display_name, $password, $email, $phone, $city, $address, $postal_code, $latitude, $longitude){
        $query = mysql_query(
                "INSERT INTO
                    company
                SET
                    comp_name = '$comp_name',
                    display_name = '$display_name',
                    password = '$password',
                    email = '$email',
                    phone = '$phone',
                    city = '$city',
                    address = '$address',
                    postal_code = '$postal_code'
                    latitude = '$latitude',
                    longitude = '$longitude'"
        );
        return $query;
    }
    
    function UpdateProfile ($comp_name, $display_name, $password, $email, $phone, $city, $address, $postal_code, $latitude, $longitude, $userId){
        $query = mysql_query(
                "UPDATE
                    company
                SET
                    comp_name = '$comp_name',
                    display_name = '$display_name',
                    password = '$password',
                    email = '$email',
                    phone = '$phone',
                    city = '$city',
                    address = '$address',
                    postal_code = '$postal_code'
                    latitude = '$latitude',
                    longitude = '$longitude'
                WHERE id='$userId'"
        );
        return $query;
    }
    
    function AutofillUpdateProfileForm ($userId) {
        $result = mysql_query(
                "SELECT *
                 FROM 
                    company
                 WHERE 
                    id = '$userId'"
        );
        return $result;
    }
