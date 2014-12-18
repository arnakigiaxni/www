<?php
    if(!isset($_SESSION['id'])) {
        header( "Location: ../controllers/index.php" );
    }    
?>

<div id="home">
    <br />
    <br />
    <div id="home_body">
        Καλώς ήρθες, <?php echo $_SESSION['display_name']; ?><br />
    </div>
</div>
