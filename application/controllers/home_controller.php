<?php

    include_once '../config/db_connect.php';
    include_once '../models/offer.php';
    mysql_query("SET NAMES utf8");
    
    class ShowOffers {
        
        function show(){
            $result = GetOffers ($_SESSION['id']);
            return $result;
        }
        
    }