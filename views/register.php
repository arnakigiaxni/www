<?php
    include_once "../includes/register.inc.php";
    include_once "../includes/functions.php";
    include_once "../js/google_maps/gmaps_helper.php";
    include "../css/graphics.php";
    
    session_start();
    if(isset($_SESSION["comp_id"])) {
        header( "Location: menu.php" );
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel='stylesheet' type='text/css' href='../css/style.css' />
        <?php
            if($successful_register!=NULL){
                echo '<meta http-equiv="refresh" content="2;url=index.php">';
            }
        ?>        
        <title>Φόρμα εγγραφής καταστήματος</title>
    </head>
    
    <body>
        <div id="menu">
            <a href='index.php'>Αρχική</a>
            <a href='add_offer.php'>Καταχώρηση</a>
            <a href='http://www.google.gr'>google</a>
            <a href='http://www.facebook.com'>facebook</a>
            <a href='http://www.twitter.com'>twitter</a>
        </div>
       <div id="register">
           <br />
       <form method='post' name='reg_form' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'>  
            Όνομα χρήστη: <input type='text' name='comp_name' maxlength='20' id="reg_username"
                <?php echo "value='$comp_name'"; ?>/>
            <span class='error'>* <?php echo $comp_nameError; ?></span>
            <br />
            <br />
            Επωνυμία καταστήματος: <input type='text' name='display_name' maxlength='20' id="reg_display"
                <?php echo "value='$display_name'"; ?>/>                                          
            <span class='error'>* <?php echo $display_nameError; ?></span>            
            <br />
            <br />
            Κωδικός: <input type='password' name='password' maxlength='20' id="reg_password"
                <?php echo "value='$password'"; ?>/>                            
            <span class='error'>* <?php echo $passwordError; ?></span> 
            <br />
            <br />
            E-mail: <input type='text' name='email' maxlength='25' id="reg_email"
                <?php echo "value='$email'"; ?>/>                           
            <span class='error'>* <?php echo $emailError; ?></span>
            <br />
            <br />
            Τηλέφωνο: <input type='text' name='phone' maxlength='10' id="reg_phone"
                <?php echo "value='$phone'"; ?> />                             
            <span class='error'>* <?php echo $phoneError; ?></span>
            <br />
            <br />
            Πατήστε
            <input type="button" value="εδώ" id="gmaps_button" onclick="window.open('../js/google_maps/gmaps.php', 'gmaps', 'width=1000,height=600')" />
             για να επιλέξετε την ακριβή τοποθεσία του καταστήματος σας στο χάρτη.
            <br />
            <br />            
            Πόλη: <input type='text' name='city' maxlength='25' readonly id="reg_city"
                <?php echo "value='$city'"; ?> />                         
            <span class='error'>* <?php echo $cityError; ?></span>
            <br />
            <br />
            Διεύθυνση: <input type='text' name='address' maxlength='50' readonly id="reg_address"
                <?php echo "value='$address'"; ?> />                              
            <span class='error'>* <?php echo $addressError; ?></span>
            <br />
            <br />  
            Ταχυδρομικός κώδικας: <input type='text' name='postal_code' maxlength='6' readonly id="reg_postal_code"
                <?php echo "value='$postal_code'"; ?> />                                         
            <span class='error'> <?php echo $postal_codeError; ?></span>            
            <br />
            <br />
            Γεωγραφικό πλάτος: <input type="text" id="info_lat" name="latitude" readonly 
                <?php echo "value='$latitude'"; ?> />                                         
            <span class='error'>* <?php echo $latitudeError; ?></span>                                       
            <br />
            <br />
            Γεωγραφικό μήκος: <input type="text" id="info_lng" name="longitude" readonly 
                <?php echo "value='$longitude'"; ?> />                                         
            <span class='error'>* <?php echo $longitudeError; ?></span>                                     
            <br />
            <br />
            <input type='submit' value='Εγγραφή' id="button" />
            <input type="button" value="Ακύρωση" onclick="window.open('index.php', '_self');") id="button"/>
            <br />
            <span class='success'><?php echo $successful_register; ?></span>
            <br />
            <h5>Είστε ήδη εγγεγραμμένος; Πατήστε <span id="here"><a href='index.php'>εδώ</a></span> για να συνδεθείτε.</h5>
       </form>
           <hr id="hr2"/>
           <br />
           <span id="copyright">OfferFinder © 2014. All rights reserved.</span> 
        </div>
    </body>
</html>

