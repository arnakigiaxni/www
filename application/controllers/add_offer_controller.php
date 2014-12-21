<?php
session_start();    
include_once '../config/db_connect.php';
include_once '../models/category.php';
include_once '../models/offer.php';
mysql_query("SET NAMES utf8");

//TODO: Delete after you fix the login issue
include_once '/login_controller.php';

$offer = new AddOfferController();
$offer->addOffer();
    
class AddOfferController {

    function addOffer() {
        $offer_name = filter_input(INPUT_POST, 'offer_name');
        $offer_descr = filter_input(INPUT_POST, 'offer_descr');
        $cat_id = filter_input(INPUT_POST, 'cat_id');
        $start_date = filter_input(INPUT_POST, 'start_date');
        $end_date = filter_input(INPUT_POST, 'end_date');
        $discount = filter_input(INPUT_POST, 'discount');
        $price = filter_input(INPUT_POST, 'price');
        
        $code = new AddOfferController();
        
        $code_name = $code->offerName($offer_name);
        $code_descr = $code->offerDescr($offer_descr);
        $code_start = $code->startDate($start_date);
        $code_end = $code->endDate($end_date);
        $code_dis = $code->discount($discount);
        $code_price = $code->price($price);   
        
        echo $code_name;
        echo $code_descr;
        echo $code_start;
        echo $code_end;
        echo $code_dis;
        echo $code_price;
        
        //TODO: fix id
        $id = $_SESSION['id'];
        if ($code_name == 0 && $code_descr == 0 && $code_start == 0 &&
                $code_end == 0 && $code_dis == 0 && $code_price == 0) {
            $new_offer = AddOffer($offer_name, $offer_descr, $cat_id, $start_date, 
                    $end_date, $discount, $price, $id);
            return $new_offer;
        } else {
            $error = "<p>Υπήρξαν σφάλματα, η καταχώρηση δεν ολοκληρώθηκε!</p>";
            return $error;
        }
    }
    
    function offerName ($offer_name){
        if (!preg_match("/^[a-zA-Z0-9\x80-\xFF\!\%\&\-\+ ]*$/", $offer_name)) {
           $errorCode = -1;
           //$error_offer_name = "Μόνο χαρακτήρες, αριθμοί και κενά επιτρέπονται"; 
        } else if (empty($offer_name)) {
           $errorCode = -2;
           //$error_offer_name = "Απαιτείται όνομα προσφοράς";
        } else {
            $errorCode = 0;
        }
        return $errorCode;
    }
    
    function offerDescr($offer_descr){
        if (!preg_match("/^[a-zA-Z0-9\x80-\xFF\.\!\%\&\-\+ ]*$/", $offer_descr)) {
            $errorCode = -3;
          //  $error_offer_descr = "Μόνο χαρακτήρες, αριθμοί και κενά επιτρέπονται";
        } else {
            $errorCode = 0;
        }
        return $errorCode;
    }
    
    function startDate($start_date){
        if (empty($start_date)) {
           $errorCode = -4;
        } else {
            $errorCode = 0;
        }
        return $errorCode;
    }
    
    function endDate($end_date){
        if (empty($end_date)) {
            $errorCode = -5;
        } else {
            $errorCode = 0;
        }
        return $errorCode;
    }
    
    function discount ($discount) {
        if (!preg_match("/^[0-9.]*$/", $discount)) {
            $errorCode = -6;
        } else if ($discount > 100 || $discount < 0) {
            $errorCode = -7;
        } else if (empty($discount)) {
           $errorCode = -8;
        } else {
            $errorCode = 0;
        }
        return $errorCode;
    }
    
    function price ($price){
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
