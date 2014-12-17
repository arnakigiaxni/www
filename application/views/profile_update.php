<?php
    session_start();
    include '../config/db_connect.php';
    include 'menu.php';
    mysql_query("SET NAMES utf8");
?>

<form action="../controllers/profile_update_controller.php" method="post" class="forms">
    <label>Όνομα χρήστη:</label><input type='text' name='comp_name' maxlength='20' id='reg_username' value="<?php echo $_SESSION['upd_comp_name']; ?>">
    <span class='error'>
    <?php if (isset ($_SESSION['error_comp_name'])) {
        echo $_SESSION['error_comp_name']; 
        unset ($_SESSION['error_comp_name']);
    }
    ?></span>
    <br />
    <br />
    <label>Επωνυμία καταστήματος:</label><input type='text' name='display_name' maxlength='20' id='reg_display' value="<?php echo $_SESSION['upd_display_name']; ?>">
    <span class='error'>
    <?php if (isset ($_SESSION['error_display_name'])) {
        echo $_SESSION['error_display_name']; 
        unset ($_SESSION['error_display_name']);
    }
    ?></span>
    <br />
    <br />
    <label>Κωδικός:</label><input type='password' name='password' maxlength='20' id='reg_password' value="<?php echo $_SESSION['upd_password']; ?>">
    <span class='error'>
    <?php if (isset ($_SESSION['error_password'])) {
        echo $_SESSION['error_password']; 
        unset ($_SESSION['error_password']);
    }
    ?></span>
    <br />
    <br />
    <label>E-mail:</label><input type='text' name='email' maxlength='25' id='reg_email' value="<?php echo $_SESSION['upd_email']; ?>">
    <span class='error'>
    <?php if (isset ($_SESSION['error_email'])) {
        echo $_SESSION['error_email']; 
        unset ($_SESSION['error_email']);
    }
    ?></span>
    <br />
    <br />
    <label>Τηλέφωνο:</label><input type='text' name='phone' maxlength='10' id='reg_phone' value="<?php echo $_SESSION['upd_phone']; ?>">
    <span class='error'>
    <?php if (isset ($_SESSION['error_phone'])) {
        echo $_SESSION['error_phone']; 
        unset ($_SESSION['error_phone']);
    }
    ?></span>
    <br />
    <br />
    Πατήστε
    <input type="button" value="εδώ" id="gmaps_button" onclick="window.open('../js/google_maps/gmaps.php', 'gmaps', 'width=1000,height=600')" />
    για να επιλέξετε την ακριβή τοποθεσία του καταστήματος σας στο χάρτη.
    <br />
    <br /> 
    <label>Πόλη:</label><input type='text' name='city' maxlength='25' readonly id='reg_city' value="<?php echo $_SESSION['upd_city']; ?>">
    <span class='error'>
    <?php if (isset ($_SESSION['error_city'])) {
        echo $_SESSION['error_city']; 
        unset ($_SESSION['error_city']);
    }
    ?></span>
    <br />
    <br />
    <label>Διεύθυνση:</label><input type='text' name='address' maxlength='50' readonly id='reg_address' value="<?php echo $_SESSION['upd_address']; ?>">
    <span class='error'>
    <?php if (isset ($_SESSION['error_address'])) {
        echo $_SESSION['error_address']; 
        unset ($_SESSION['error_address']);
    }
    ?></span>
    <br />
    <br />
    <label>Ταχυδρομικός κώδικας:</label><input type='text' name='postal_code' maxlength='6' readonly id='reg_postal_code' value="<?php echo $_SESSION['upd_postal_code']; ?>">
    <span class='error'>
    <?php if (isset ($_SESSION['error_postal_code'])) {
        echo $_SESSION['error_postal_code']; 
        unset ($_SESSION['error_postal_code']);
    }
    ?></span>
    <br />
    <br />
    <label>Γεωγραφικό πλάτος:</label><input type='text' name='latitude' id='info_lat' readonly value="<?php echo $_SESSION['upd_latitude']; ?>">
    <span class='error'>
    <?php if (isset ($_SESSION['error_latitude'])) {
        echo $_SESSION['error_latitude']; 
        unset ($_SESSION['error_latitude']);
    }
    ?></span>
    <br />
    <br />
    <label>Γεωγραφικό μήκος:</label><input type='text' name='longitude' id='info_lng' readonly value="<?php echo $_SESSION['upd_longitude']; ?>">
    <span class='error'>
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