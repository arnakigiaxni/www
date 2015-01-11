<?php    
include_once '/../config/db_connect.php';
include_once '/../models/category.php';
include_once '/../models/offer.php';
include_once "ImageManipulator.php";
session_start();

class AddOfferController {

    function addOffer($offer_name, $offer_descr, $cat_id, $start_date, 
                    $end_date, $discount, $price) {        
        $code = new AddOfferController();
        
        $code_name = $code->validateOfferName($offer_name);
        $code_descr = $code->validateOfferDescr($offer_descr);
        $code_start = $code->validateStartDate($start_date);
        $code_end = $code->validateEndDate($end_date);
        $code_dis = $code->validateDiscount($discount);
        $code_price = $code->validatePrice($price);
        $error_codes = array($code_name, $code_descr, $code_start, $code_end, $code_dis, $code_price);
        
        if ($code_name == 0 && $code_descr == 0 && $code_start == 0 &&
                $code_end == 0 && $code_dis == 0 && $code_price == 0) {
            $new_offer = AddOffer($offer_name, $offer_descr, $cat_id, $start_date, 
                    $end_date, $discount, $price, $_SESSION['id']);
            if ($new_offer != false){
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
    
    function validateOfferName ($offer_name){
        if (!preg_match("/^[a-zA-Z0-9\x80-\xFF\!\%\&\-\+ ]*$/", $offer_name)) {
           $errorCode = -1;
        } else if (empty($offer_name)) {
           $errorCode = -2;
        } else {
            $errorCode = 0;
        }
        return $errorCode;
    }
    
    function validateOfferDescr($offer_descr){
        if (!preg_match("/^[a-zA-Z0-9\x80-\xFF\.\!\%\&\-\+ ]*$/", $offer_descr)) {
            $errorCode = -3;
        } else {
            $errorCode = 0;
        }
        return $errorCode;
    }
    
    function validateStartDate($start_date){
        if (empty($start_date)) {
           $errorCode = -4;
        } else {
            $errorCode = 0;
        }
        return $errorCode;
    }
    
    function validateEndDate($end_date){
        if (empty($end_date)) {
            $errorCode = -5;
        } else {
            $errorCode = 0;
        }
        return $errorCode;
    }
    
    function validateDiscount ($discount) {
        if (!preg_match("/^[0-9.]*$/", $discount)) {
            $errorCode = -6;
        } else if ($discount > 100) {
            $errorCode = -7;
        } else if (empty($discount)) {
           $errorCode = -8;
        } else {
            $errorCode = 0;
        }
        return $errorCode;
    }
    
    function validatePrice ($price){
        if (!preg_match("/^[0-9.]*$/", $price)) {
            $errorCode = -9;
        } else if (empty($price)) {
            $errorCode = -10;
        } else {
            $errorCode = 0;
        }
        return $errorCode;
    }
    
}

