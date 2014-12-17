<?php
    session_start();
    
    include '../config/db_connect.php';
    include '../models/category.php';
    include '../models/offer.php';
    
    $offer_name = filter_input(INPUT_POST, 'offer_name');
    $offer_descr = filter_input(INPUT_POST, 'offer_descr');
    $cat_id = filter_input(INPUT_POST, 'cat_id');
    $start_date = filter_input(INPUT_POST, 'start_date');
    $end_date = filter_input(INPUT_POST, 'end_date');
    $discount = filter_input(INPUT_POST, 'discount');
    $price = filter_input(INPUT_POST, 'price');
    
    if (!preg_match("/^[a-zA-Z0-9\x80-\xFF\!\%\&\-\+ ]*$/",$offer_name)) {
        $_SESSION['error_name'] = "Μόνο χαρακτήρες, αριθμοί και κενά επιτρέπονται"; 
        $_SESSION['offer_error'] = true;
    }
    else if (empty ($offer_name)){
        $_SESSION['error_name'] = "Απαιτείται όνομα προσφοράς";
        $_SESSION['offer_error'] = true;
    }
    
    if (!preg_match("/^[a-zA-Z0-9\x80-\xFF\.\!\%\&\-\+ ]*$/",$offer_descr)) {
        $_SESSION['error_descr'] = "Μόνο χαρακτήρες, αριθμοί και κενά επιτρέπονται"; 
        $_SESSION['offer_error'] = true;
    }    
    
    if (empty ($start_date)){
        $_SESSION['error_sdate'] = "Απαιτείται ημερομηνία έναρξης";
        $_SESSION['offer_error'] = true;
    }
    
    if (empty ($end_date)){
        $_SESSION['error_edate'] = "Απαιτείται ημερομηνία έναρξης";
        $_SESSION['offer_error'] = true;
    }
    
    if (!preg_match("/^[0-9.]*$/",$discount)) {
        $_SESSION['error_discount'] = "Μόνο αριθμοί και η διαχωριστική . επιτρέπονται"; 
        $_SESSION['offer_error'] = true;
    }
    else if ($discount > 100){
        $_SESSION['error_discount'] = "Δεν μπορείτε να έχετε έκπτωση πάνω απο 100%";
        $_SESSION['offer_error'] = true;
    }
    else if (empty ($discount)){
        $_SESSION['error_discount'] = "Aπαιτείται ποσοστό προσφοράς";
        $_SESSION['offer_error'] = true;
    }
    
    if (!preg_match("/^[0-9.]*$/",$price)) {
        $_SESSION['error_price'] = "Μόνο αριθμοί και η διαχωριστική . επιτρέπονται"; 
        $_SESSION['offer_error'] = true;
    }
    else if (empty ($price)){
        $_SESSION['error_price'] = "Απαιτείται τιμή";
        $_SESSION['offer_error'] = true;
    }
        
    if (!isset($_SESSION['offer_error'])) {
        $new_offer = AddOffer($offer_name, $offer_descr, $cat_id, $start_date, $end_date, $discount, $price, $_SESSION['id']);
        $_SESSION['success'] = "Η προσφορά καταχωρήθηκε επιτυχώς!";
    }
    unset ($_SESSION['offer_error']);
    header( 'Location: ../views/add_offer.php');
?>
