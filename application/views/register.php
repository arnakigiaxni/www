<?php
    include '../config/db_connect.php';
    include 'menu.php';
    include_once "../../public/js/google_maps/gmaps_helper.php";
?>

    <form action="../controllers/register_controller.php" method="post" class="forms">
	<label>Όνομα χρήστη:</label><input type='text' name='comp_name' maxlength='20' id='comp_name'></input>
        <span class='error'>* 
        <?php if (isset ($_SESSION['error_comp_name'])) {
                echo $_SESSION['error_comp_name']; 
                unset ($_SESSION['error_comp_name']);
            }
        ?></span>
        <br />
        <br />
	<label>Επωνυμία καταστήματος:</label><input type='text' name='display_name' maxlength='20' id='display_name'></input>
        <span class='error'>* 
        <?php if (isset ($_SESSION['error_display_name'])) {
                echo $_SESSION['error_display_name']; 
                unset ($_SESSION['error_display_name']);
            }
        ?></span>
        <br />
        <br />
	<label>Κωδικός:</label><input type='text' name='password' maxlength='20' id='password'></input>
        <span class='error'>* 
        <?php if (isset ($_SESSION['error_password'])) {
                echo $_SESSION['error_password']; 
                unset ($_SESSION['error_password']);
            }
        ?></span>
        <br />
        <br />     
	<label>Email:</label><input type='text' name='email' maxlength='25' id='email'></input>
        <span class='error'>* 
        <?php if (isset ($_SESSION['error_email'])) {
                echo $_SESSION['error_email']; 
                unset ($_SESSION['error_email']);
            }
        ?></span>
        <br />
        <br />
 	<label>Τηλέφωνο:</label><input type='text' name='phone' maxlength='10' id='phone'></input>
        <span class='error'>* 
        <?php if (isset ($_SESSION['error_phone'])) {
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
 	<label>Πόλη:</label><input type='text' name='city' maxlength='25' readonly id='city'></input>
        <span class='error'>* 
        <?php if (isset ($_SESSION['error_city'])) {
                echo $_SESSION['error_city']; 
                unset ($_SESSION['error_city']);
            }
        ?></span>
        <br />
        <br />
 	<label>Διεύθυνση:</label><input type='text' name='address' maxlength='50' readonly id='reg_address'></input>
        <span class='error'>* 
        <?php if (isset ($_SESSION['error_address'])) {
                echo $_SESSION['error_address']; 
                unset ($_SESSION['error_address']);
            }
        ?></span>
        <br />
        <br />
 	<label>Ταχυδρομικός κώδικας:</label><input type='text' name='postal_code' maxlength='6' readonly id='postal_code'></input>
        <span class='error'>* 
        <?php if (isset ($_SESSION['error_postal_code'])) {
                echo $_SESSION['error_postal_code']; 
                unset ($_SESSION['error_postal_code']);
            }
        ?></span>
        <br />
        <br />
 	<label>Γεωγραφικό πλάτος:</label><input type='text' name='latitude' maxlength='30' readonly id='info_lat'></input>
        <span class='error'>* 
        <?php if (isset ($_SESSION['error_latitude'])) {
                echo $_SESSION['error_latitude']; 
                unset ($_SESSION['error_latitude']);
            }
        ?></span>
        <br />
        <br />
 	<label>Γεωγραφικό μήκος:</label><input type='text' name='longitude' maxlength='30' readonly id='info_lng'></input>
        <span class='error'>* 
        <?php if (isset ($_SESSION['error_longitude'])) {
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
?>        