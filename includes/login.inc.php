<?php

    include_once "db_connect.php";
    include_once "functions.php";
    include_once "../views/index.php";
    mysql_query("SET NAMES utf8");
    
    $comp_name = $password = "";
    $login_Error = "";
    $success_login = "";
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $comp_name = test_input($_POST["comp_name"]);
            $password = test_input($_POST["password"]);
            
            $query = "SELECT * from company WHERE comp_name='".mysql_real_escape_string($comp_name)."' AND password='".mysql_real_escape_string($password)."'  LIMIT 1";
            $result = mysql_query($query) or die(mysql_error());
            $num_rows = mysql_num_rows($result);
            
            if ($num_rows == 1) {
                $company = mysql_fetch_array($result);
                session_start();
                $_SESSION['comp_name'] = $company['comp_name'];
                $_SESSION['comp_id'] = $company['id'];
                //header( "Location: menu.php" );
                
                $success_login = "Επιτυχής σύνδεση";
                
            } else {
		$login_Error = "Το όνομα χρήστη ή ο κωδικός σας είναι λάθος, προσπαθήστε ξανά.";
            }
        }