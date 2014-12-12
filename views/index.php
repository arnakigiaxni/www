<?php
    include_once "../includes/db_connect.php";
    include_once "../includes/functions.php";
    include_once "../includes/login.inc.php";
    include "../css/graphics.php";
    
    session_start();
    if(isset($_SESSION["comp_id"])) {
        header( "Location: menu.php" );
    }
    
?>
<html>
    <head>
        <title>Καλώς Ήρθατε</title>
        <meta charset="UTF-8">
        <link rel='stylesheet' type='text/css' href='../css/style.css' />
        <?php
            if($success_login!=NULL){
                echo '<meta http-equiv="refresh" content="1;url=menu.php">';
            }
        ?>

    </head>
    
    <body>
        <div id="menu">
            <a href='index.php'>Αρχική</a>
            <a href='add_offer.php'>Καταχώρηση</a>
            <a href='http://www.google.gr'>google</a>
            <a href='http://www.facebook.com'>facebook</a>
            <a href='http://www.twitter.com'>twitter</a>
        </div>
        <div id='login'>

		<br /><br />
		<form method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' >
                    Όνομα χρήστη: <input type='text' name='comp_name' id="username"
                              <?php echo "value='$comp_name'"; ?> />
                <br />
                <br />
                Κωδικός: <input type='password' name='password' id="password"
                         <?php echo "value='$password'"; ?>/>       
                    <br />
                    <br />
                <input type='submit' value='Είσοδος' id="button"/>
                    <br />
                    <br />
                    <span class='error'><?php echo $login_Error; ?></span>
                    <span class='success'><?php echo $success_login; ?></span>
                    <br />
                    <h5> Δεν είστε μέλος; Πατήστε <span id="here"><a href='register.php'>εδώ</a></span> για να εγγραφείτε. </h5>
            </form>
            
            <br />
            
            <hr />
            <?php
//                $query = "SELECT * FROM about";
//                        $result = mysql_query($query) or die(mysql_error());
//                        while($row=mysql_fetch_array($result)) {
//                            echo $row[0];
//                        }
            ?>
            vesrion 0.3
            <br />
            <span id="copyright">OfferFinder © 2014. All rights reserved.</span> 
        </div>
    </body>
</html>
