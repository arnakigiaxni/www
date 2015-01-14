<?php
    include_once '../config/db_connect.php';
    include_once '../../public/js/google_maps/gmaps_helper.php';
    include_once '../controllers/show_data.php';
    include_once '../controllers/profile_update_controller.php';
    mysql_query("SET NAMES utf8");

    if(!isset($_SESSION['id'])) {
        header( "Location: ../controllers/index.php" );
    }  
    
    $frm = filter_input(INPUT_SERVER, 'PHP_SELF', FILTER_SANITIZE_STRING);
    $srv = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
    $msg = "Επεξεργαστείτε το προφίλ σας αλλάζοντας τα παρακάτω πεδία";
    if ($srv == 'POST'){
        $comp_name = filter_input(INPUT_POST, 'comp_name');
        $display_name = filter_input(INPUT_POST, 'display_name');
        $password = filter_input(INPUT_POST, 'password');
        $email = filter_input(INPUT_POST, 'email');
        $phone = filter_input(INPUT_POST, 'phone');
        $city = filter_input(INPUT_POST, 'city');
        $address = filter_input(INPUT_POST, 'address');
        $postal_code = filter_input(INPUT_POST, 'postal_code');
        $latitude = filter_input(INPUT_POST, 'latitude');
        $longitude = filter_input(INPUT_POST, 'longitude');

        $update = new ProfileUpdateController();
        $update_res = $update->profileUpdate($comp_name, $display_name, $password,
                $email, $phone, $city, $address, $postal_code, $latitude, $longitude);
    }
    else {
        $update = new ShowData();
        $update_res = $update->show();
        $comp_name = $update_res['comp_name'];
        $display_name = $update_res['display_name'];
        $password = $update_res['password'];
        $email = $update_res['email'];
        $phone = $update_res['phone'];
        $city = $update_res['city'];
        $address = $update_res['address'];
        $postal_code = $update_res['postal_code'];
        $latitude = $update_res['latitude'];
        $longitude = $update_res['longitude'];
    }
?>

<!DOCTYPE>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../../public/css/style.css" />
         <?php
            if (isset ($update_res)){
               if(in_array("1", $update_res)){
                   echo '<meta http-equiv="refresh" content="2;url=../controllers/index.php">';
               }
            }
         ?>        
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
    <div id="update">
    <br />
    <?php
    if (isset ($update_res)){
        if (in_array("1", $update_res)) {
            $msg = "Το προφίλ σας ενημερώθηκε επιτυχώς!";
        }
    }
    echo "<h3>$msg</h3>";
    ?>
    <br />
    <br />
    <form action="<?php echo $frm?>" method="post" class="forms" name='reg_form'>
        <label>Όνομα χρήστη:</label><input type='text' name='comp_name' maxlength='20' id='reg_username'
        <?php
            if (isset($comp_name)){
                echo 'value="' . $comp_name . '"';
            }
        ?> > 
        <span class='error'>*
        <?php 
            if (isset ($update_res)) {
                if (in_array("-1", $update_res)) {
                    echo "Το όνομα χρήστη υπάρχει ήδη!";
                } 
                else if (in_array("-2", $update_res)) {
                    echo "Απαιτείται όνομα χρήστη"; 
                }
                else if (in_array("-3", $update_res)) {
                    echo "8 έως 20 χαρακτήρες ή αριθμούς και underscore";
                }
            }
        ?></span>
        <br />
        <br />
        <label>Επωνυμία καταστήματος:</label><input type='text' name='display_name' maxlength='20' id='reg_display'
        <?php
            if (isset($display_name)){
                echo 'value="'.$display_name.'"';
            }          
        ?> >
        <span class='error'>*
        <?php 
            if (isset ($update_res)) {
                if (in_array("-4", $update_res)) {
                    echo "Απαιτείται επωνυμία καταστήματος";
                } 
                else if (in_array("-5", $update_res)) {
                    echo "Μόνο χαρακτήρες, αριθμοί και κενά επιτρέπονται"; 
                }
            }
        ?></span>
        <br />
        <br />
        <label>Κωδικός:</label><input type='password' name='password' maxlength='20' id='reg_password'
        <?php
            if (isset($password)){
                echo 'value="'.$password.'"';
            }
        ?> >
        <span class='error'>*
        <?php 
            if (isset ($update_res)) {
                if (in_array("-6", $update_res)) {
                    echo "Απαιτείται κωδικός";
                } 
                else if (in_array("-7", $update_res)) {
                    echo "8 έως 20 χαρακτήρες ή αριθμούς και underscore"; 
                }
            }
        ?></span>
        <br />
        <br />
        <label>E-mail:</label><input type='text' name='email' maxlength='25' id='reg_email'
        <?php
            if (isset($email)){
                echo 'value="'.$email.'"';
            }
        ?> >
        <span class='error'>*
        <?php 
            if (isset ($update_res)) {
                if (in_array("-8", $update_res)) {
                    echo "Το email υπάρχει ήδη";
                } 
                else if (in_array("-9", $update_res)) {
                    echo "Απαιτείται email"; 
                }
                else if (in_array("-10", $update_res)) {
                    echo "Λανθασμένη μορφή email"; 
                }
            }
        ?></span>
        <br />
        <br />
        <label>Τηλέφωνο:</label><input type='text' name='phone' maxlength='10' id='reg_phone'
        <?php
            if (isset($phone)){
                echo 'value="'.$phone.'"';
            }
        ?> >
        <span class='error'>*
        <?php 
            if (isset ($update_res)) {
                if (in_array("-11", $update_res)) {
                    echo "Το τηλέφωνο υπάρχει ήδη";
                } 
                else if (in_array("-12", $update_res)) {
                    echo "Απαιτείται τηλέφωνο"; 
                }
                else if (in_array("-13", $update_res)) {
                    echo "Απαιτούνται ακριβώς 10 νούμερα"; 
                }
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
            if (isset($city)){
                echo 'value="'.$city.'"';
            }
        ?> >
        <span class='error'>*
        <?php 
            if (isset ($update_res)) {
                if (in_array("-14", $update_res)) {
                    echo "Απαιτείται πόλη";
                } 
            }
        ?></span>
        <br />
        <br />
        <label>Διεύθυνση:</label><input type='text' name='address' maxlength='50' readonly id='reg_address'
        <?php
            if (isset($address)){
                echo 'value="'.$address.'"';
            }
        ?> >
        <span class='error'>*
        <?php 
            if (isset ($update_res)) {
                if (in_array("-15", $update_res)) {
                    echo "Απαιτείται διεύθυνση";
                } 
            }
        ?></span>
        <br />
        <br />
        <label>Ταχυδρομικός κώδικας:</label><input type='text' name='postal_code' maxlength='6' readonly id='reg_postal_code'
        <?php
            if (isset($postal_code)){
                echo 'value="'.$postal_code.'"';
            }
        ?> >
        <span class='error'>
        <?php 
            if (isset ($update_res)) {
                if (in_array("-16", $update_res)) {
                    echo "Απαιτείται ταχυδρομικός κώδικας";
                } 
            }
        ?></span>
        <br />
        <br />
        <label>Γεωγραφικό πλάτος:</label><input type='text' name='latitude' id='info_lat' readonly
        <?php
            if (isset($latitude)){
                echo 'value="'.$latitude.'"';
            }
        ?> > 
        <span class='error'>*
        <?php 
            if (isset ($update_res)) {
                if (in_array("-17", $update_res)) {
                    echo "Απαιτείται γεωγραφικό πλάτος";
                } 
            }
        ?></span>
        <br />
        <br />
        <label>Γεωγραφικό μήκος:</label><input type='text' name='longitude' id='info_lng' readonly
        <?php
            if (isset($longitude)){
                echo 'value="'.$longitude.'"';
            }
        ?> > 
        <span class='error'>*
        <?php 
            if (isset ($update_res)) {
                if (in_array("-18", $update_res)) {
                    echo "Απαιτείται γεωγραφικό μήκος";
                } 
            }
        ?></span>
        <br />
        <br />
        <br />
        <br />
        <input type="submit" value="Επεξεργασία" class="buttons" id="button"/>
        <br />
        <br />
        <input type="button" value="Ακύρωση" id="button" onclick="window.open('../controllers/index.php', '_self');")/>
    </form>
    </div>
    <?php
        include 'footer.php';
    ?>
