<div id='login'>
<?php
    if(isset($_SESSION['id'])) {
        header( "Location: ../index.php" );
    }    
?>
<br /><br />
<form method='post' action='../controllers/login_controller.php' >
    <label>Όνομα Χρήστη:</label> <input type="text" name="username" id="username" />
    <br /><br />
    <label>Κωδικός:</label> <input type="password" name="password" id="password"/>
    <br /><br />
    <input type="submit" value="Σύνδεση" id="button" />
</form>
<?php
    if (isset ($_SESSION['message'])){
        echo "<p>" . $_SESSION['message'] . "</p>";
        unset($_SESSION['message']);
    }
?>
<br />
<h5> Δεν είστε μέλος; Πατήστε <span id="here"><a href='../views/register.php'>εδώ</a></span> για να εγγραφείτε. </h5>
</div>

