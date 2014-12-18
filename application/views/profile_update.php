<?php
    session_start();
    include_once '../config/db_connect.php';
    include_once '../../public/js/google_maps/gmaps_helper.php';
    include_once '../controllers/show_data.php';
    mysql_query("SET NAMES utf8");

    if(!isset($_SESSION['id'])) {
        header( "Location: ../controllers/index.php" );
    }    
?>

<!DOCTYPE>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../../public/css/style.css" />
        <link rel="icon" type="image/png" href="../../public/img/favicon.png" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Επεξεργασία προφίλ</title>
    </head>

    <body>
	<div id="graphics">
        <a href="../controllers/index.php"><img src="../../public/img/header.png"/></a>
        </div>
    <?php
    include 'menu.php';
    ?>
        
    <form action="../controllers/profile_update_controller.php" method="post" class="forms" name='reg_form'>
        <label>Όνομα χρήστη:</label><input type='text' name='comp_name' maxlength='20' id='reg_username'
        <?php
            if (isset($_SESSION['comp_name'])){
                echo "value=" . $_SESSION['comp_name'] ;
                unset ($_SESSION['comp_name']);
            }
        ?> > 
        <span class='error'>
        <?php 
            if (isset ($_SESSION['error_comp_name'])) {
                echo $_SESSION['error_comp_name']; 
                unset ($_SESSION['error_comp_name']);
            }
        ?></span>
        <br />
        <br />
        <label>Επωνυμία καταστήματος:</label><input type='text' name='display_name' maxlength='20' id='reg_display'
        <?php
            if (isset($_SESSION['display_name_upd'])){
                echo "value=" . $_SESSION['display_name_upd'] ;
                unset ($_SESSION['display_name_upd']);
            }            
        ?> >
        <span class='error'>
        <?php 
            if (isset ($_SESSION['error_display_name'])) {
                echo $_SESSION['error_display_name']; 
                unset ($_SESSION['error_display_name']);
            }
        ?></span>
        <br />
        <br />
        <label>Κωδικός:</label><input type='password' name='password' maxlength='20' id='reg_password'
        <?php
            if (isset($_SESSION['password'])){
                echo "value=" . $_SESSION['password'] ;
                unset ($_SESSION['password']);
            }
        ?> >
        <span class='error'>
        <?php 
            if (isset ($_SESSION['error_password'])) {
                echo $_SESSION['error_password']; 
                unset ($_SESSION['error_password']);
            }
        ?></span>
        <br />
        <br />
        <label>E-mail:</label><input type='text' name='email' maxlength='25' id='reg_email'
        <?php
            if (isset($_SESSION['email'])){
                echo "value=" . $_SESSION['email'] ;
                unset ($_SESSION['email']);
            }
        ?> >
        <span class='error'>
        <?php 
            if (isset ($_SESSION['error_email'])) {
                echo $_SESSION['error_email']; 
                unset ($_SESSION['error_email']);
            }
        ?></span>
        <br />
        <br />
        <label>Τηλέφωνο:</label><input type='text' name='phone' maxlength='10' id='reg_phone'
        <?php
            if (isset($_SESSION['phone'])){
                echo "value=" . $_SESSION['phone'] ;
                unset ($_SESSION['phone']);
            }
        ?> >
        <span class='error'>
        <?php 
            if (isset ($_SESSION['error_phone'])) {
                echo $_SESSION['error_phone']; 
                unset ($_SESSION['error_phone']);
            }
        ?></span>
        <br />
        <br />
        Πατήστε
        <input type="button" value="εδώ" id="gmaps_button" onclick="window.open('../../public/js/google_maps/gmaps.php', 'gmaps', 'width=1000,height=600')" />
        για να επιλέξετε την ακριβή τοποθεσία του καταστήματος σας στο χάρτη.
        <br />
        <br /> 
        <label>Πόλη:</label><input type='text' name='city' maxlength='25' readonly id='reg_city'
        <?php
            if (isset($_SESSION['city'])){
                echo "value=" . $_SESSION['city'] ;
                unset ($_SESSION['city']);
            }
        ?> >
        <span class='error'>
        <?php 
            if (isset ($_SESSION['error_city'])) {
                echo $_SESSION['error_city']; 
                unset ($_SESSION['error_city']);
            }
        ?></span>
        <br />
        <br />
        <label>Διεύθυνση:</label><input type='text' name='address' maxlength='50' readonly id='reg_address'
        <?php
            if (isset($_SESSION['address'])){
                echo "value=" . $_SESSION['address'];
                unset ($_SESSION['address']);
            }
        ?> >
        <span class='error'>
        <?php 
            if (isset ($_SESSION['error_address'])) {
                echo $_SESSION['error_address']; 
                unset ($_SESSION['error_address']);
            }
        ?></span>
        <br />
        <br />
        <label>Ταχυδρομικός κώδικας:</label><input type='text' name='postal_code' maxlength='6' readonly id='reg_postal_code'
        <?php
            if (isset($_SESSION['postal_code'])){
                echo "value=" . $_SESSION['postal_code'] ;
                unset ($_SESSION['postal_code']);
            }
        ?> >
        <span class='error'>
        <?php 
            if (isset ($_SESSION['error_postal_code'])) {
                echo $_SESSION['error_postal_code']; 
                unset ($_SESSION['error_postal_code']);
            }
        ?></span>
        <br />
        <br />
        <label>Γεωγραφικό πλάτος:</label><input type='text' name='latitude' id='info_lat' readonly
        <?php
            if (isset($_SESSION['latitude'])){
                echo "value=" . $_SESSION['latitude'] ;
                unset ($_SESSION['latitude']);
            }
        ?> > 
        <span class='error'>
        <?php 
            if (isset ($_SESSION['error_latitude'])) {
                echo $_SESSION['error_latitude']; 
                unset ($_SESSION['error_latitude']);
            }
        ?></span>
        <br />
        <br />
        <label>Γεωγραφικό μήκος:</label><input type='text' name='longitude' id='info_lng' readonly
        <?php
            if (isset($_SESSION['longitude'])){
                echo "value=" . $_SESSION['longitude'] ;
                unset ($_SESSION['longitude']);
            }
        ?> > 
        <span class='error'>
        <?php 
            if (isset ($_SESSION['error_longitude'])) {
                echo $_SESSION['error_longitude']; 
                unset ($_SESSION['error_longitude']);
            }
        ?></span>
        <br />
        <br />
        <input type="submit" value="Εγγραφή" class="buttons"/>
    </form>
    <?php
        if (isset($_SESSION['success'])){
            echo $_SESSION['success'];
            unset ($_SESSION['success']);
        }
        include 'footer.php';
