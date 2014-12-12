<?php

    include_once "../includes/functions.php";
    include_once "../includes/db_connect.php";
    include_once "../includes/update_profile.inc.php";
    include_once "../js/google_maps/gmaps_helper.php";
    include "../css/graphics.php";
    mysql_query("SET NAMES utf8");
    
    session_start();
    if(isset($_SESSION["comp_id"])) {
        $id = $_SESSION["comp_id"];
    }
    else {
        header( "Location: index.php" );
    }  
    
    $query = "SELECT * from company WHERE id=$id LIMIT 1";
    $result = mysql_query($query) or die(mysql_error());
    $company = mysql_fetch_array($result);
    
 ?>   
    
<html>
    <head>
        <meta charset="UTF-8">
        <link rel='stylesheet' type='text/css' href='../css/style.css' />
        <?php
            if($successful_update!=NULL){
                echo '<meta http-equiv="refresh" content="2;url=menu.php">';
            }
        ?>         
        <title>Επεξεργασία προφίλ</title>
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
                <?php  
                    if($comp_name!=NULL){
                        echo "value='$comp_name'";
                    }
                    else {
                        echo 'value = "'.$company['comp_name'].'"';
                    }
                ?>/>
            <span class='error'>* <?php echo $comp_nameError; ?></span>
            <br />
            <br />
            Επωνυμία καταστήματος: <input type='text' name='display_name' maxlength='20' id="reg_display"
                <?php  
                    if($display_name!=NULL){
                        echo "value='$display_name'";
                    }
                    else {
                        echo 'value = "'.$company['display_name'].'"';
                    }
                ?>/>                                          
            <span class='error'>* <?php echo $display_nameError; ?></span>            
            <br />
            <br />
            Κωδικός: <input type='password' name='password' maxlength='20' id="reg_password"
                <?php  
                    if($password!=NULL){
                        echo "value='$password'";
                    }
                    else {
                        echo 'value = "'.$company['password'].'"';
                    }
                ?>/>                            
            <span class='error'>* <?php echo $passwordError; ?></span> 
            <br />
            <br />
            E-mail: <input type='text' name='email' maxlength='25' id="reg_email"
                <?php  
                    if($email!=NULL){
                        echo "value='$email'";
                    }
                    else {
                        echo 'value = "'.$company['email'].'"';
                    }
                ?>/>                           
            <span class='error'>* <?php echo $emailError; ?></span>
            <br />
            <br />
            Τηλέφωνο: <input type='text' name='phone' maxlength='10' id="reg_phone"
                <?php  
                    if($phone!=NULL){
                        echo "value='$phone'";
                    }
                    else {
                        echo 'value = "'.$company['phone'].'"';
                    }
                ?>/>                             
            <span class='error'>* <?php echo $phoneError; ?></span>
            <br />
            <br />
            Πατήστε
            <input type="button" value="εδώ" id="gmaps_button" onclick="window.open('../js/google_maps/gmaps.php', 'gmaps', 'width=1000,height=600')" />
             για να επιλέξετε την ακριβή τοποθεσία του καταστήματος σας στο χάρτη.
            <br />
            <br />            
            Πόλη: <input type='text' name='city' maxlength='25' readonly id="reg_city"
                <?php  
                    if($city!=NULL){
                        echo "value='$city'";
                    }
                    else {
                        echo 'value = "'.$company['city'].'"';
                    }
                ?>/>                        
            <span class='error'>* <?php echo $cityError; ?></span>
            <br />
            <br />
            Διεύθυνση: <input type='text' name='address' maxlength='50' readonly id="reg_address"
                <?php  
                    if($address!=NULL){
                        echo "value='$address'";
                    }
                    else {
                        echo 'value = "'.$company['address'].'"';
                    }
                ?>/>                              
            <span class='error'>* <?php echo $addressError; ?></span>
            <br />
            <br />  
            Ταχυδρομικός κώδικας: <input type='text' name='postal_code' maxlength='6' readonly id="reg_postal_code"
                <?php  
                    if($postal_code!=NULL){
                        echo "value='$postal_code'";
                    }
                    else {
                        echo 'value = "'.$company['postal_code'].'"';
                    }
                ?>/>                                         
            <span class='error'> <?php echo $postal_codeError; ?></span>            
            <br />
            <br />
            Γεωγραφικό πλάτος: <input type="text" id="info_lat" name="latitude" readonly 
                <?php  
                    if($latitude!=NULL){
                        echo "value='$latitude'";
                    }
                    else {
                        echo 'value = "'.$company['latitude'].'"';
                    }
                ?>/>                                         
            <span class='error'>* <?php echo $latitudeError; ?></span>                                       
            <br />
            <br />
            Γεωγραφικό μήκος: <input type="text" id="info_lng" name="longitude" readonly 
                <?php  
                    if($longitude!=NULL){
                        echo "value='$longitude'";
                    }
                    else {
                        echo 'value = "'.$company['longitude'].'"';
                    }
                ?>/>                                         
            <span class='error'>* <?php echo $longitudeError; ?></span>                                     
            <br />
            <br />
            <input type='submit' value='Ενημέρωση προφίλ' id="button" />
            <input type="button" value="Ακύρωση" id="button" onclick="window.open('menu.php', '_self');")/>
            <br />
            <span class='success'><?php echo $successful_update; ?></span>
       </form>
           <hr id="hr4"/>
           <br />
           <span id="copyright">OfferFinder © 2014. All rights reserved.</span>
            </div>
    </body>
</html>    

