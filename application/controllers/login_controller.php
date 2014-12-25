<?php
    
    include_once '/../models/company.php';
    include_once '/../config/db_connect.php';
    mysql_query("SET NAMES utf8");
    
    class loginController {
        
        function login($username, $password) {

                $result = AuthenticateUser($username, $password);
                if ($result !== false) {
                    $_SESSION['id'] = $result['id'];  
                    $_SESSION['display_name'] = $result['display_name'];
                    
                    return -1;
                }
                else {
                    return -2;
                }

        }
    
}