<?php
    include_once "../includes/db_connect.php";
?>
<html>
    <head>
        <title>Καλώς Ήρθατε</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form action='submit_login.php' method='post'>
            Όνομα χρήστη: <input type='text' name='username' />
                <br />
                <br />
            Κωδικός: <input type='password' name='password' />  
                <br />
                <br />
            <input type='submit' value='Είσοδος'/>
                <br/>
                <h5> Δεν είστε μέλος; Πατήστε <a href='register.php'>εδώ</a> για να εγγραφείτε. </h5>
        </form>
        <a href='add_offer.php'>Καταχώρηση</a>
        <br />
        <br />
        <?php
        $query = "SELECT * FROM about";
                    $result = mysql_query($query) or die(mysql_error());
                    while($row=mysql_fetch_array($result)) {
                        echo $row[0];
                    }
        ?>
    </body>
</html>
