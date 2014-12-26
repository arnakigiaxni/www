<?php
        
        function AuthenticateUser($username, $password){
            $query = mysql_query(
                    "SELECT
                        id, display_name
                     FROM
                        company
                     WHERE
                        comp_name = '$username'
                        AND password = '$password'"
            );
            if (mysql_num_rows($query) == 1 ) {
                $result = mysql_fetch_array($query);
                return $result;
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
                        postal_code = '$postal_code',
                        latitude = '$latitude',
                        longitude = '$longitude'"
            );
            if (mysql_affected_rows()==1){
                return $query;
            }
            else{
                return false;
            }
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
                        postal_code = '$postal_code',
                        latitude = '$latitude',
                        longitude = '$longitude'
                    WHERE id='$userId'"
            );
            return $query;
        }

        function AutofillUpdateProfileForm ($userId) {
            $query = mysql_query(
                    "SELECT
                        *
                     FROM
                        company
                     WHERE
                        id = '$userId'"
            );

            if (mysql_num_rows($query) == 1 ) {
                $result = mysql_fetch_array($query);
                return $result;
            }
            else {
                return false;
            }
        }

        function RegisterCompNameExists ($comp_name){
            $query = mysql_query(
                    "SELECT
                        *
                     FROM
                        company
                     WHERE
                        comp_name = '$comp_name'"
            );

             if (mysql_num_rows($query) == 1 ) {
                return true;
            }
            else {
                return false;
            }          
        }


        function RegisterEmailExists ($email){
            $query = mysql_query(
                    "SELECT
                        *
                     FROM
                        company
                     WHERE
                        email = '$email'"
            );

             if (mysql_num_rows($query) == 1 ) {
                return true;
            }
            else {
                return false;
            }          
        }    

        function RegisterPhoneExists ($phone){
            $query = mysql_query(
                    "SELECT
                        *
                     FROM
                        company
                     WHERE
                        phone = '$phone'"
            );

             if (mysql_num_rows($query) == 1 ) {
                return true;
            }
            else {
                return false;
            }          
        }

        function UpdateCompNameExists ($comp_name, $id){
            $query = mysql_query(
                    "SELECT
                        *
                    FROM 
                        company 
                    WHERE 
                        comp_name = '$comp_name' AND id != '$id'"
                    );

            if (mysql_num_rows($query) == 1 ) {
                return true;
            }
            else {
                return false;
            }          
        }

        function UpdateEmailExists ($email, $id){
            $query = mysql_query(
                    "SELECT
                        *
                     FROM
                        company
                     WHERE
                        email = '$email' AND id != '$id'"
            );

            if (mysql_num_rows($query) == 1 ) {
                return true;
            }
            else {
                return false;
            }          
        }    

        function UpdatePhoneExists ($phone, $id){
            $query = mysql_query(
                    "SELECT
                        *
                     FROM
                        company
                     WHERE
                        phone = '$phone' AND id != '$id'"
            );

             if (mysql_num_rows($query) == 1 ) {
                return true;
            }
            else {
                return false;
            }          
        }
    