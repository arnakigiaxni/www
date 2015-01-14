<?php
    include_once '/../config/db_connect.php';
    include_once '/../models/offer.php';
    include_once '/../controllers/delete_offer_controller.php';
    mysql_query("SET NAMES utf8");

    if(!isset($_SESSION['id'])) {
        header( "Location: ../controllers/index.php" );
    }    
    
    $msg = "Επιλέξτε μια από τις παρακάτω προσφορές για διαγραφή";
    $frm = filter_input(INPUT_SERVER, 'PHP_SELF', FILTER_SANITIZE_STRING);
    $srv = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
    if($srv == 'POST'){
        $offer_id = filter_input(INPUT_POST, 'id');
        $delete = new DeleteOfferController();
        $result = $delete->DeleteOffer($offer_id);
        if ($result !== false) {
            $msg = "Η προσφορά ".$result." διαγράφηκε επιτυχώς";
        }
    }
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../../public/css/style.css" />
        <link rel="icon" type="image/png" href="../../public/img/favicon.png" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Διαγραφή προσφοράς</title>
    </head>

    <body>
	<div id="graphics">
        <a href="../controllers/index.php"><img src="../../public/img/header.png"/></a>
        </div>
    <?php
        include 'menu.php';
    ?>
    <div id="delete_offer">
        <br />
        <?php
        echo "<h3>$msg</h3>";
        ?>    
    <form action="<?php echo $frm?>" method="post" class="forms" enctype="multipart/form-data">
        <br />
        <br />
        <label>Προσφορές: </label><select name='id' id="add_cat_id"><?php ShowOffers($_SESSION['id']) ?></select>
        <span class='error'></span>
        <br />
        <br />
        <input type="submit" name="submit" value="Διαγραφή" class="buttons" id="button">
        <br />
        <br />
        <input type="button" value="Ακύρωση" id="button" onclick="window.open('../controllers/index.php', '_self');")/>
    </form>
    </div>
<?php
    include 'footer.php';
?>

