<?php
    include "../css/graphics.php";

    session_start();
    if(isset($_SESSION["comp_name"])) {
        $comp_name = $_SESSION["comp_name"];
    }
    else {
        header( "Location: index.php" );
    }
?>

<html>
    <head>
        <title>Μενού</title>
        <meta charset="UTF-8">
        <link rel='stylesheet' type='text/css' href='../css/style.css' />
    </head>

    <body>
        <div id="menu">
            <a href='index.php'>Αρχική</a>
            <a href='add_offer.php'>Καταχώρηση</a>
            <a href='http://www.google.gr'>google</a>
            <a href='http://www.facebook.com'>facebook</a>
            <a href='http://www.twitter.com'>twitter</a>
        </div>  
        <div id="add_offer">
            <br />
            <span class="right">Καλώς ήρθες, <?php echo $comp_name; ?><br />
            <a href='update_profile.php'>Επεξεργασία προφίλ</a><br />
            <a href='../includes/logout.inc.php'>Αποσύνδεση</a></span>
        </div>
        <br />
        <br />
        <a href='add_offer.php'>Καταχώρηση</a>
    </body>
</html>