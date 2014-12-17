<?php
    session_start();
    include '../config/db_connect.php';
    include '../models/category.php';
    include 'menu.php';
?>
<form action="../controllers/add_offer_controller.php" method="post" class="forms">
	<label>Όνομα προσφοράς:</label><input type='text' name='offer_name' maxlength='30' id='add_offer_name'></input>
        <span class='error'>* 
        <?php if (isset ($_SESSION['error_name'])) {
                echo $_SESSION['error_name']; 
                unset ($_SESSION['error_name']);
            }
        ?></span>
        <br />
        <br />
        <label>Περιγραφή προσφοράς:</label><textarea name='offer_descr' maxlength='160' id="add_offer_descr" rows='5' cols='57'></textarea>
        <span class='error'>
        <?php if (isset ($_SESSION['error_descr'])) {
                echo $_SESSION['error_descr']; 
                unset ($_SESSION['error_descr']);
            }
        ?></span>
        <br />
        <br />
        <label>Κατηγορία προσφοράς:</label><select name='cat_id' id="add_cat_id"><?php ShowCategories() ?></select>
        <span class='error'>*</span>
        <br />
        <br />
        <label>Ημερομηνία έναρξης προσφοράς:</label><input type='text' id='demo1' maxlength='10' name='start_date' readonly size='10'></input>
        <img src="../../public/js/date_picker/images2/cal.gif" onclick="javascript:NewCssCal('demo1','yyyyMMdd','','','','','future')" style="cursor:pointer"/> 
        <span class='error'>* 
        <?php if (isset ($_SESSION['error_sdate'])) {
                echo $_SESSION['error_sdate']; 
                unset ($_SESSION['error_sdate']);
            }
        ?></span> 
        <br />
        <br />
        <label>Ημερομηνία λήξης προσφοράς:</label><input type='text' id='demo2' maxlength='10' name='end_date' readonly size='10'></input>
        <img src="../../public/js/date_picker/images2/cal.gif" onclick="javascript:NewCssCal('demo2','yyyyMMdd','','','','','future')" style="cursor:pointer"/>   
        <span class='error'>* 
        <?php if (isset ($_SESSION['error_edate'])) {
                echo $_SESSION['error_edate']; 
                unset ($_SESSION['error_edate']);
            }
        ?></span>
        <br />
        <br />
        <label>Ποσοστό έκπτωσης (%):</label><input type='text' name='discount' maxlength='4' id="add_discount"></input>
        <span class='error'>* 
        <?php if (isset ($_SESSION['error_discount'])) {
                echo $_SESSION['error_discount']; 
                unset ($_SESSION['error_discount']);
            }
        ?></span>
        <br />
        <br />
        <label>Τιμή μετά την έκπτωση (€):</label><input type='text' name='price' maxlength='8' id="add_price"></input>
        <span class='error'>* 
        <?php if (isset ($_SESSION['error_price'])) {
                echo $_SESSION['error_price']; 
                unset ($_SESSION['error_price']);
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

