<?php
    include_once '/../config/db_connect.php';
    include_once '/../models/category.php';
    include_once '/../controllers/add_offer_controller.php';
    mysql_query("SET NAMES utf8");

    if(!isset($_SESSION['id'])) {
        header( "Location: ../controllers/index.php" );
    }    
    
    $frm = filter_input(INPUT_SERVER, 'PHP_SELF', FILTER_SANITIZE_STRING);
    $srv = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
    if($srv == 'POST'){
        $offer_name = filter_input(INPUT_POST, 'offer_name');
        $offer_descr = filter_input(INPUT_POST, 'offer_descr');
        $cat_id = filter_input(INPUT_POST, 'cat_id');
        $start_date = filter_input(INPUT_POST, 'start_date');
        $end_date = filter_input(INPUT_POST, 'end_date');
        $discount = filter_input(INPUT_POST, 'discount');
        $price = filter_input(INPUT_POST, 'price');
        $path = "/../../public/uploads/";
        
        $offer = new AddOfferController();
        $offervar = $offer->addOffer($offer_name, $offer_descr, $cat_id, $start_date, 
                    $end_date, $discount, $price);
    }
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../../public/css/style.css" />
         <?php
            if (isset ($offervar)){
               if(in_array("1", $offervar)){
                   echo '<meta http-equiv="refresh" content="2;url=../controllers/index.php">';
               }
            }
         ?>
        <link rel="icon" type="image/png" href="../../public/img/favicon.png" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Καταχώρηση προσφοράς</title>
    </head>

    <body>
	<div id="graphics">
        <a href="../controllers/index.php"><img src="../../public/img/header.png"/></a>
        </div>
    <?php
        include 'menu.php';
    ?>
    <div id="add_offer">
    <?php
    if (isset ($offervar)){
        if (in_array("1", $offervar)) {
            echo "Η προσφορά καταχωρήθηκε επιτυχώς!";
            unset($offer_name, $offer_descr, $cat_id, $start_date, $end_date, 
                    $discount, $price);
        }
    }
    ?>
    <br />
    <br />
    <form action="<?php echo $frm?>" method="post" class="forms" enctype="multipart/form-data">
	<label>Όνομα προσφοράς:</label><input type='text' name='offer_name' maxlength='30' id='add_offer_name'
        <?php
            if (isset ($offer_name)){
                echo "value=" . $offer_name;
            }
        ?> >
        <span class='error'>*
        <?php
            if (isset ($offervar)){
                if (in_array("-1", $offervar)) {
                    echo "Μόνο χαρακτήρες, αριθμοί και κενά επιτρέπονται"; 
                } 
                else if (in_array("-2", $offervar)) {
                    echo "Απαιτείται όνομα προσφοράς";
                }
            }
        ?>
        </span>
        <br />
        <br />
        <label>Περιγραφή προσφοράς:<br /></label><textarea name='offer_descr' maxlength='160' id="add_offer_descr" rows='5' cols='57'><?php 
            if (isset ($offer_name)){
                echo $offer_descr ;
            }
        ?></textarea>
        <span class='error'>
        <?php
            if (isset ($offervar)){
                if (in_array("-3", $offervar)) {
                    echo "Μόνο χαρακτήρες, αριθμοί και κενά επιτρέπονται"; 
                } 
            }
        ?>
        </span>
        <br />
        <br />
        <label>Κατηγορία προσφοράς:</label><select name='cat_id' id="add_cat_id"><?php ShowCategories($cat_id) ?></select>
        <span class='error'>*</span>
        <br />
        <br />
        <label>Ημερομηνία έναρξης προσφοράς:</label><input type='text' id='demo1' maxlength='10' name='start_date' readonly size='10'
        <?php
            if (isset ($offer_name)){
                echo "value=" . $start_date;
            }
        ?> >
        <img src="../../public/js/date_picker/images2/cal.gif" onclick="javascript:NewCssCal('demo1','yyyyMMdd','','','','','future')" style="cursor:pointer"/> 
        <span class='error'>* 
        <?php
            if (isset ($offervar)){
                if (in_array("-4", $offervar)) {
                    echo "Απαιτείται ημερομηνία έναρξης"; 
                } 
            }
        ?>
        </span> 
        <br />
        <br />
        <label>Ημερομηνία λήξης προσφοράς:</label><input type='text' id='demo2' maxlength='10' name='end_date' readonly size='10'
        <?php
            if (isset ($offer_name)){
                echo "value=" . $end_date;
            }
        ?> >
        <img src="../../public/js/date_picker/images2/cal.gif" onclick="javascript:NewCssCal('demo2','yyyyMMdd','','','','','future')" style="cursor:pointer"/>   
        <span class='error'>* 
        <?php
            if (isset ($offervar)){
                if (in_array("-5", $offervar)) {
                    echo "Απαιτείται ημερομηνία λήξης"; 
                } 
            }
        ?>    
        </span>
        <br />
        <br />
        <label>Ποσοστό έκπτωσης (%):</label><input type='text' name='discount' maxlength='4' id="add_discount"
        <?php
            if (isset ($offer_name)){
                echo "value=" . $discount;
            }
        ?> >
        <span class='error'>*
        <?php
            if (isset ($offervar)){
                if (in_array("-6", $offervar)) {
                    echo "Μόνο αριθμοί και η διαχωριστική . επιτρέπονται";
                } 
                else if (in_array("-7", $offervar)) {
                    echo "Εισάγετε μια έγκυρη τιμή";
                }
                else if (in_array("-8", $offervar)) {
                    echo "Aπαιτείται ποσοστό προσφοράς";
                }
            }
        ?>
        </span>
        <br />
        <br />
        <label>Τιμή μετά την έκπτωση (€):</label><input type='text' name='price' maxlength='8' id="add_price"
        <?php
            if (isset ($offer_name)){
                echo "value=" . $price;
            }
        ?>>
        <span class='error'>* 
        <?php
            if (isset ($offervar)){
                if (in_array("-9", $offervar)) {
                    echo "Μόνο αριθμοί και η διαχωριστική . επιτρέπονται";
                } 
                else if (in_array("-10", $offervar)) {
                    echo "Απαιτείται τιμή";
                }
            }
        ?>
        </span>
        <br />
        <br />
        <input type="submit" name="submit" value="Καταχώρηση" class="buttons" id="button">
        <input type="button" value="Ακύρωση" id="button" onclick="window.open('../controllers/index.php', '_self');")/>
    </form>
    </div>
<?php
    include 'footer.php';
?>

