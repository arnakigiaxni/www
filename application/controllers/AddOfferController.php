<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AddOfferController
 *
 * @author Stelios
 */
class AddOfferController {

    function addOffer($offer_name, $offer_descr, $cat_id, $start_date, $end_date, $discount, $price) {
        $errorCode = 0;
        if (!preg_match("/^[a-zA-Z0-9\x80-\xFF\!\%\&\-\+ ]*$/", $offer_name)) {
            $errorCode = -1;
        } else if (empty($_SESSION['offer_name'])) {
           $errorCode = -2;
        }
        if (!preg_match("/^[a-zA-Z0-9\x80-\xFF\.\!\%\&\-\+ ]*$/", $_SESSION['offer_descr'])) {
            $errorCode = -3;
        }

        if (empty($_SESSION['start_date'])) {
           $errorCode = -4;
        }

        if (empty($_SESSION['end_date'])) {
            $errorCode = -5;
        }

        if (!preg_match("/^[0-9.]*$/", $_SESSION['discount'])) {
            $errorCode = -6;
        } else if ($_SESSION['discount'] > 100 || $_SESSION['discount'] < 0) {
            $errorCode = -7;
        } else if (empty($_SESSION['discount'])) {
           $errorCode = -8;
        }

        if (!preg_match("/^[0-9.]*$/", $_SESSION['price'])) {
            $errorCode = -9;
        } else if (empty($_SESSION['price'])) {
           $errorCode = -10;
        }

        if ($errorCode == 0) {
            $new_offer = AddOffer($_SESSION['offer_name'], $_SESSION['offer_descr'], $_SESSION['cat_id'], $_SESSION['start_date'], $_SESSION['end_date'], $_SESSION['discount'], $_SESSION['price'], $_SESSION['id']);
        } 
        return $errorCode;
    }

}
