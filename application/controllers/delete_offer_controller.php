<?php    
include_once '/../config/db_connect.php';
include_once '/../models/offer.php';
session_start();
mysql_query("SET NAMES utf8");

class DeleteOfferController {
        
    function DeleteOffer($offer_id) {
        deleteOffer($offer_id);
    }
    
}

