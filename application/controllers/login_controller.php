<?php
    session_start();
    
    include_once '../models/company.php';
    include_once '../config/db_connect.php';
    mysql_query("SET NAMES utf8");
    
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');
    if( isset ($username, $password)){
        $userId = AuthenticateUser($username, $password);
        if ($userId !== false) {
            $_SESSION['id'] = $userId['id'];  
            $_SESSION['display_name'] = $userId['display_name'];
        }
        else {
            $_SESSION['message'] = "Το όνομα χρήστη ή ο κωδικός σας είναι λάθος, προσπαθήστε ξανά.";
        }
        header( 'Location: index.php');
    }
