<?php
    include_once "../includes/add_offer.inc.php";
    include_once "../includes/functions.php";
    include_once "../includes/db_connect.php";
    include "../css/graphics.php";
    mysql_query("SET NAMES utf8");
    error_reporting(0);
    
    session_start();
    if(isset($_SESSION["comp_name"])) {
        $comp_name = $_SESSION["comp_name"];
    }
    else {
        header( "Location: index.php" );
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel='stylesheet' type='text/css' href='../css/style.css' />
        <?php
            if($successful_add!=NULL){
                echo '<meta http-equiv="refresh" content="2;url=menu.php">';
            }
        ?> 
        <script src="../js/date_picker/datetimepicker_css.js"></script>
        <title>Καταχώρηση νέας προσφοράς</title>
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
            <br />
            <br />
            <br />
       <form method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' enctype="multipart/form-data">  
            Όνομα προσφοράς: <input type='text' name='offer_name' maxlength='30' id="add_offer_name"
                <?php echo "value='$offer_name'"; ?>/>
            <span class='error'>* <?php echo $offer_nameError; ?></span>
            <br />
            <br />
            Περιγραφή προσφοράς: <br /><textarea name='offer_descr' maxlength='160' id="add_offer_descr" rows='5' cols='57'><?php echo "$offer_descr"; ?></textarea>
            <span class='error'> <?php echo $offer_descrError; ?></span>            
            <br />
            <br />
            Κατηγορία προσφοράς: <select name='cat_id' id="add_cat_id">  
                <?php if($cat_id!=NULL){
                        $query = "SELECT id, cat_name FROM category WHERE id=$cat_id";
                        $result = mysql_query($query) or die(mysql_error());
                            while($row=mysql_fetch_array($result)) {
                                echo '<option value="'.$row['id'].'" selected>'.$row['cat_name'].'</option>';
                            }
                      }
                      
                        $query = "SELECT id, cat_name FROM category WHERE id!=$cat_id";
                        $result = mysql_query($query) or die(mysql_error());
                            while($row=mysql_fetch_array($result)) {
                                echo '<option value="'.$row['id'].'">'.$row['cat_name'].'</option>';
                            }
                ?>
            </select>
            <span class='error'>* </span>
            <br />
            <br />
            Ημερομηνία έναρξης προσφοράς:  <input type='text' id='demo1' maxlength='10' name='start_date' readonly size='10'
                <?php echo "value='$start_date'"; ?>/> 
                <img src="../js/date_picker/images2/cal.gif" onclick="javascript:NewCssCal('demo1','yyyyMMdd','','','','','future')" style="cursor:pointer"/> 
            <span class='error'>* <?php echo $start_dateError; ?></span> 
            <br />
            <br />
            Ημερομηνία λήξης προσφοράς: <input type='text' id='demo2' maxlength='10' name='end_date' readonly size='10'
                <?php echo "value='$end_date'"; ?>/> 
                <img src="../js/date_picker/images2/cal.gif" onclick="javascript:NewCssCal('demo2','yyyyMMdd','','','','','future')" style="cursor:pointer"/>   
            <span class='error'>* <?php echo $end_dateError; ?></span> 
            <br />
            <br />
            Ποσοστό προσφοράς (%): <input type='text' name='discount' maxlength='4' id="add_discount"
                <?php echo "value='$discount'"; ?>/>
            <span class='error'>* <?php echo $discountError; ?></span>
            <br />
            <br />
            Τιμή μετά την προσφορά (€): <input type='text' name='price' maxlength='8' id="add_price"
                <?php echo "value='$price'"; ?>/>
            <span class='error'>* <?php echo $priceError; ?></span>
            <br />
            <br />
            <input type='submit' value='Καταχώρηση προσφοράς' id="button"/>
            <input type="button" value="Ακύρωση" id="button" onclick="window.open('menu.php', '_self');")/>
            <br />
            <br />
            <span class='success'><?php echo $successful_add; ?></span>
          </form>
            <hr id="hr3"/>
            <br />
           <span id="copyright">OfferFinder © 2014. All rights reserved.</span>
      </div>
    </body>
</html>

