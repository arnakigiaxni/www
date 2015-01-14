<?php
    session_start();
    include_once "/../config/db_connect.php";
    include_once "/../../public/js/google_maps/gmaps_helper.php";
    include_once '/../controllers/register_controller.php';
    mysql_query("SET NAMES utf8");
    
    if(isset($_SESSION['id'])) {
        header( "Location: ../controllers/index.php" );
    }
    
    $frm = filter_input(INPUT_SERVER, 'PHP_SELF', FILTER_SANITIZE_STRING);
    $srv = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
    $msg = "Συμπληρώστε τα παρακάτω πεδία για να εγγραφείτε";
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
         <?php
            if (isset ($registervar)){
               if(in_array("1", $registervar)){
                   echo '<meta http-equiv="refresh" content="2;url=../controllers/index.php">';
               }
            }
         ?>        
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
    <br />
    <?php
        if (isset ($registervar)){
            if (in_array("1", $registervar)) {
                $msg = "Επιτυχής εγγραφή";
                unset($comp_name, $display_name, $password, $email, $phone, $city, $address, 
                $postal_code, $latitude, $longitude);
            }
        }
        echo "<h3>$msg</h3>";
    ?>    
    <br />
    <br />
    <form action="<?php echo $frm?>" method="post" class="forms" name='reg_form'>
	<label>Όνομα χρήστη:</label><input type='text' name='comp_name' maxlength='20' id='reg_username' value="<?php if (isset ($comp_name)){ echo $comp_name; } ?>">                                
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
	<label>Επωνυμία καταστήματος:</label><input type='text' name='display_name' maxlength='20' id='reg_display' value="<?php if (isset ($display_name)){ echo $display_name; } ?>">          
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
	<label>Κωδικός:</label><input type='password' name='password' maxlength='20' id='reg_password' value="<?php if (isset ($password)){ echo $password; } ?>">                                        
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
	<label>E-mail:</label><input type='text' name='email' maxlength='25' id='reg_email' value="<?php if (isset ($email)){ echo $email; } ?>">                                    
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
 	<label>Τηλέφωνο:</label><input type='text' name='phone' maxlength='10' id='reg_phone' value="<?php if (isset ($phone)){ echo $phone; } ?>">                                       
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
 	<label>Πόλη:</label><input type='text' name='city' maxlength='25' readonly id='reg_city' value="<?php if (isset ($city)){ echo $city; } ?>">                                     
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
 	<label>Διεύθυνση:</label><input type='text' name='address' maxlength='50' readonly id='reg_address' value="<?php if (isset ($address)){ echo $address; } ?>">                                         
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
 	<label>Ταχυδρομικός κώδικας:</label><input type='text' name='postal_code' maxlength='6' readonly id='reg_postal_code' value="<?php if (isset ($postal_code)){ echo $postal_code; } ?>">                                                   
        <br />
        <br />
 	<label>Γεωγραφικό πλάτος:</label><input type='text' name='latitude' maxlength='30' readonly id='info_lat' value="<?php if (isset ($latitude)){ echo $latitude; } ?>">                                                
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
 	<label>Γεωγραφικό μήκος:</label><input type='text' name='longitude' maxlength='30' readonly id='info_lng' value="<?php if (isset ($longitude)){ echo $longitude; } ?>">                                                 
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
        <br />
        <br />
        <input type="submit" value="Εγγραφή" class="buttons" name="submit" id="button">
        <br />
        <br />
        <input type="button" value="Ακύρωση" id="button" onclick="window.open('../controllers/index.php', '_self');")/>
    </form>
    </div>
<?php
    include 'footer.php';
?>        