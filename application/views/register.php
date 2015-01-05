<?php
    session_start();
    include_once "/../config/db_connect.php";
    include_once "/../../public/js/google_maps/gmaps_helper.php";
    include_once '/../controllers/register_controller.php';
    mysql_query("SET NAMES utf8");
    
    $frm = filter_input(INPUT_SERVER, 'PHP_SELF', FILTER_SANITIZE_STRING);
    $srv = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
    if($srv == 'POST'){
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
        
        $register = new RegisterController();
        $registervar = $register->addCompany($comp_name, $display_name, $password, $email, $phone, $city, $address, 
                $postal_code, $latitude, $longitude);
    }    
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../../public/css/style.css" />
        <link rel="icon" type="image/png" href="../../public/img/favicon.png" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Εγγραφή νέου χρήστη</title>
    </head>

    <body>
       
	<div id="graphics">
        <a href="../controllers/index.php"><img src="../../public/img/header.png"/></a>
        </div>
    <?php
        include 'menu.php';
    ?>
    <div id="register">
    <?php
        if (isset ($registervar)){
            if (in_array("1", $registervar)) {
                echo "Επιτυχής εγγραφή!";
                unset($comp_name, $display_name, $password, $email, $phone, $city, $address, 
                $postal_code, $latitude, $longitude);
            }
        }
    ?>    
        
    <form action="<?php echo $frm?>" method="post" class="forms" name='reg_form'>
	<label>Όνομα χρήστη:</label><input type='text' name='comp_name' maxlength='20' id='reg_username'
        <?php
            if (isset ($comp_name)){
                echo "value=" . $comp_name;
            }
        ?> >                                 
        <span class='error'>* 
        <?php
            if (isset ($registervar)){
                if (in_array("-1", $registervar)) {
                    echo "Απαιτείται όνομα χρήστη"; 
                } 
                else if (in_array("-2", $registervar)) {
                    echo "8 έως 20 χαρακτήρες ή αριθμούς και underscore";
                }
                else if (in_array("-3", $registervar)) {
                    echo "Το όνομα χρήστη υπάρχει ήδη";
                }
            }
        ?>
        </span>
        <br />
        <br />
	<label>Επωνυμία καταστήματος:</label><input type='text' name='display_name' maxlength='20' id='reg_display'
        <?php
            if (isset ($display_name)){
                echo "value=" . $display_name;
            }
        ?> >         
        <span class='error'>* 
        <?php
            if (isset ($registervar)){
                if (in_array("-4", $registervar)) {
                    echo "Απαιτείται επωνυμία καταστήματος"; 
                } 
                else if (in_array("-5", $registervar)) {
                    echo "Μόνο χαρακτήρες, αριθμοί και κενά επιτρέπονται";
                }
            }
        ?>
        </span>
        <br />
        <br />
	<label>Κωδικός:</label><input type='password' name='password' maxlength='20' id='reg_password'                                      
        <?php
            if (isset ($password)){
                echo "value=" . $password;
            }
        ?> >                                        
        <span class='error'>* 
        <?php
            if (isset ($registervar)){
                if (in_array("-6", $registervar)) {
                    echo "Απαιτείται κωδικός πρόσβασης"; 
                } 
                else if (in_array("-7", $registervar)) {
                    echo "8 έως 20 χαρακτήρες ή αριθμούς και underscore";
                }
            }
        ?>
        </span>
        <br />
        <br />     
	<label>Email:</label><input type='text' name='email' maxlength='25' id='reg_email'
         <?php
            if (isset ($email)){
                echo "value=" . $email;
            }
        ?> >                                     
        <span class='error'>* 
        <?php
            if (isset ($registervar)){
                if (in_array("-8", $registervar)) {
                    echo "Απαιτείται email"; 
                } 
                else if (in_array("-9", $registervar)) {
                    echo "Λανθασμένη μορφή email";
                }
                else if (in_array("-10", $registervar)) {
                    echo "Το email υπάρχει ήδη";
                }
            }
        ?>
        </span>
        <br />
        <br />
 	<label>Τηλέφωνο:</label><input type='text' name='phone' maxlength='10' id='reg_phone'
         <?php
            if (isset ($phone)){
                echo "value=" . $phone;
            }
        ?> >                                        
        <span class='error'>* 
        <?php
            if (isset ($registervar)){
                if (in_array("-11", $registervar)) {
                    echo "Απαιτείται τηλέφωνο"; 
                } 
                else if (in_array("-12", $registervar)) {
                    echo "Απαιτούνται ακριβώς 10 ψηφία";
                }
                else if (in_array("-13", $registervar)) {
                    echo "Το τηλέφωνο υπάρχει ήδη";
                }
            }
        ?>
        </span>
        <br />
        <br />      
        Πατήστε
        <input type="button" value="εδώ" id="gmaps_button" onclick="window.open('../../public/js/google_maps/gmaps.php', 'gmaps', 'width=1000,height=600')" >
             για να επιλέξετε την ακριβή τοποθεσία του καταστήματος σας στο χάρτη.
        <br />
        <br />   
 	<label>Πόλη:</label><input type='text' name='city' maxlength='25' readonly id='reg_city'
         <?php
            if (isset ($city)){
                echo "value=" . $city;
            }
        ?> >                                    
        <span class='error'>* 
        <?php
            if (isset ($registervar)){
                if (in_array("-14", $registervar)) {
                    echo "Απαιτείται πόλη"; 
                } 
            }
        ?>
        </span>
        <br />
        <br />
 	<label>Διεύθυνση:</label><input type='text' name='address' maxlength='50' readonly id='reg_address'
         <?php
            if (isset ($address)){
                echo "value=" . $address;
            }
        ?> >                                         
        <span class='error'>* 
       <?php
            if (isset ($registervar)){
                if (in_array("-15", $registervar)) {
                    echo "Απαιτείται διεύθυνση"; 
                } 
            }
        ?>
        </span>
        <br />
        <br />
 	<label>Ταχυδρομικός κώδικας:</label><input type='text' name='postal_code' maxlength='6' readonly id='reg_postal_code'
         <?php
            if (isset ($postal_code)){
                echo "value=" . $postal_code;
            }
        ?> >                                                    
        <br />
        <br />
 	<label>Γεωγραφικό πλάτος:</label><input type='text' name='latitude' maxlength='30' readonly id='info_lat'
         <?php
            if (isset ($latitude)){
                echo "value=" . $latitude;
            }
        ?> >                                                 
        <span class='error'>* 
       <?php
            if (isset ($registervar)){
                if (in_array("-16", $registervar)) {
                    echo "Απαιτείται γεωγραφικό πλάτος"; 
                } 
            }
        ?>
        </span>
        <br />
        <br />
 	<label>Γεωγραφικό μήκος:</label><input type='text' name='longitude' maxlength='30' readonly id='info_lng'
         <?php
            if (isset ($longitude)){
                echo "value=" . $longitude;
            }
        ?> >                                                
        <span class='error'>* 
       <?php
            if (isset ($registervar)){
                if (in_array("-17", $registervar)) {
                    echo "Απαιτείται γεωγραφικό μήκος"; 
                } 
            }
        ?>
        </span>
        <br />
        <br />
        <input type="submit" value="Εγγραφή" class="buttons" name="submit">
    </form>
    </div>
<?php
    include 'footer.php';
?>        