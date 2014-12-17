<?php
    if(!isset($_SESSION['id'])) {
        header( "Location: ../controllers/index.php" );
    }    
?>
<div id="add_offer">
    <br />
    <span class="right">Καλώς ήρθες, <?php echo $_SESSION['display_name']; ?><br />
        <a href='../views/profile_update.php'>Επεξεργασία προφίλ</a><br />
    <a href='../controllers/logout.php'>Αποσύνδεση</a></span>
</div>
<br />
<br />
<a href='../views/add_offer.php'>Καταχώρηση</a>
