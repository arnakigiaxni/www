<?php
    if(isset($_SESSION['id'])) {
        header( "Location: ../index.php" );
    }    
?>
<br /><br />
<form method='post' action='../controllers/login_controller.php' >
    <label>Όνομα Χρήστη:</label> <input type="text" name="username" id="username" />
    <label>Κωδικός:</label> <input type="password" name="password" />
    <input type="submit" value="Είσοδος" class="submit" />
</form>
<?php
    if (isset ($_SESSION['message'])){
        echo "<p>" . $_SESSION['message'] . "</p>";
        unset($_SESSION['message']);
    }
?>
<h5> Δεν είστε μέλος; Πατήστε <span id="here"><a href='register.php'>εδώ</a></span> για να εγγραφείτε. </h5>

