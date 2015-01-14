<?php    
include_once '/../config/db_connect.php';
include_once '/../models/offer.php';
session_start();

class DeleteOfferController {
        
    function DeleteOffer($offer_id) {
        $controller = new DeleteOfferController();
        $result = $controller->GetOfferName($offer_id);
        $delete = deleteOffer($offer_id);
        if ($delete != false) {
            return $result;
        }
        else{
            return false;
        }
    }
    
    function GetOfferName ($offer_id) {
        $result = GetOfferById($offer_id);
        if ($result !== false) {
            $offer = mysql_fetch_array($result);
            return $offer["offer_name"];
        }
        else { 
            return false;
        }
    }
 
}

