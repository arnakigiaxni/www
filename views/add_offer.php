<?php
    include_once "../includes/add_offer.inc.php";
    include_once "../includes/functions.php";
    include_once "../includes/db_connect.php";
    mysql_query("SET NAMES utf8");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel='stylesheet' type='text/css' href='../css/style.css' />
        <script src="../js/date_picker/datetimepicker_css.js"></script>
        <title>Φόρμα καταχώρησης προσφοράς</title>
    </head>
    
    <body>
       <p><span class='error'>* Απαραίτητο πεδίο</span></p>
       <form method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>'>  
            Όνομα προσφοράς: <input type='text' name='offer_name' maxlength='30' 
                <?php echo "value='$offer_name'"; ?>/>
            <span class='error'>* <?php echo $offer_nameError; ?></span>
            <br />
            <br />
            Περιγραφή προσφοράς: <br /><textarea name='offer_descr' maxlength='160' rows='5' cols='50'><?php echo "$offer_descr"; ?></textarea>
            <span class='error'> <?php echo $offer_descrError; ?></span>            
            <br />
            <br />
            Κατηγορία προσφοράς: <select name='cat_id'>  
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
            Ποσοστό προσφοράς (%): <input type='text' name='discount' maxlength='4' 
                <?php echo "value='$discount'"; ?>/>
            <span class='error'>* <?php echo $discountError; ?></span>
            <br />
            <br />
            Τιμή μετά την προσφορά (€): <input type='text' name='price' maxlength='8' 
                <?php echo "value='$price'"; ?>/>
            <span class='error'>* <?php echo $priceError; ?></span>
            <br />
            <br />  
            <input type='submit' value='Καταχώρηση προσφοράς'/>
            <br />
            <br />
            <span class='success'><?php echo $successful_add; ?></span>
       </form>
    </body>
</html>

