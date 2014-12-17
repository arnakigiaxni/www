<?php
    session_start();
    
    include '../config/db_connect.php';
    include '../models/category.php';
    include '../models/offer.php';
    
    $_SESSION['offer_name'] = filter_input(INPUT_POST, 'offer_name');
    $_SESSION['offer_descr'] = filter_input(INPUT_POST, 'offer_descr');
    $_SESSION['cat_id'] = filter_input(INPUT_POST, 'cat_id');
    $_SESSION['start_date'] = filter_input(INPUT_POST, 'start_date');
    $_SESSION['end_date'] = filter_input(INPUT_POST, 'end_date');
    $_SESSION['discount'] = filter_input(INPUT_POST, 'discount');
    $_SESSION['price'] = filter_input(INPUT_POST, 'price');
    
    if (!preg_match("/^[a-zA-Z0-9\x80-\xFF\!\%\&\-\+ ]*$/",$_SESSION['offer_name'])) {
        $_SESSION['error_name'] = "Μόνο χαρακτήρες, αριθμοί και κενά επιτρέπονται"; 
        $_SESSION['offer_error'] = true;
    }
    else if (empty($_SESSION['offer_name'])){
        $_SESSION['error_name'] = "Απαιτείται όνομα προσφοράς";
        $_SESSION['offer_error'] = true;
    }
    
    if (!preg_match("/^[a-zA-Z0-9\x80-\xFF\.\!\%\&\-\+ ]*$/",$_SESSION['offer_descr'])) {
        $_SESSION['error_descr'] = "Μόνο χαρακτήρες, αριθμοί και κενά επιτρέπονται"; 
        $_SESSION['offer_error'] = true;
    }    
    
    if (empty ($_SESSION['start_date'])){
        $_SESSION['error_sdate'] = "Απαιτείται ημερομηνία έναρξης";
        $_SESSION['offer_error'] = true;
    }
    
    if (empty ($_SESSION['end_date'])){
        $_SESSION['error_edate'] = "Απαιτείται ημερομηνία έναρξης";
        $_SESSION['offer_error'] = true;
    }
    
    if (!preg_match("/^[0-9.]*$/",$_SESSION['discount'])) {
        $_SESSION['error_discount'] = "Μόνο αριθμοί και η διαχωριστική . επιτρέπονται"; 
        $_SESSION['offer_error'] = true;
    }
    else if ($_SESSION['discount'] > 100 || $_SESSION['discount'] < 0){
        $_SESSION['error_discount'] = "Εισάγετε μια έγκυρη τιμή";
        $_SESSION['offer_error'] = true;
    }
    else if (empty ($_SESSION['discount'])){
        $_SESSION['error_discount'] = "Aπαιτείται ποσοστό προσφοράς";
        $_SESSION['offer_error'] = true;
    }
    
    if (!preg_match("/^[0-9.]*$/",$_SESSION['price'])) {
        $_SESSION['error_price'] = "Μόνο αριθμοί και η διαχωριστική . επιτρέπονται"; 
        $_SESSION['offer_error'] = true;
    }
    else if (empty ($_SESSION['price'])){
        $_SESSION['error_price'] = "Απαιτείται τιμή";
        $_SESSION['offer_error'] = true;
    }
        
    if (!isset($_SESSION['offer_error'])) {
        $new_offer = AddOffer($_SESSION['offer_name'], $_SESSION['offer_descr'], 
                $_SESSION['cat_id'], $_SESSION['start_date'], $_SESSION['end_date'], 
                $_SESSION['discount'], $_SESSION['price'], $_SESSION['id']);
        $_SESSION['success'] = "Η προσφορά καταχωρήθηκε επιτυχώς!";
    }
    unset ($_SESSION['offer_error']);
    header( 'Location: ../views/add_offer.php');
?>
