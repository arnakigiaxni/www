<?php
    include_once '/../config/db_connect.php';
    require '/../controllers/login_controller.php';
    mysql_query("SET NAMES utf8");

    $result = null;
    
    $frm = filter_input(INPUT_SERVER, 'PHP_SELF', FILTER_SANITIZE_STRING);
    $srv = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
    if($srv == 'POST'){
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        $controller = new loginController();
        $result = $controller->login($username, $password);
        if ($result == -1) {
            header( 'Location: index.php');
        }
    }
?>

<div id='login'>
<br /><br />
<form action="<?php echo $frm?>" method="post" class="forms">
    <label>Όνομα χρήστη:</label> <input type="text" name="username" id="username" />
    <br /><br />
    <label>Κωδικός:</label> <input type="password" name="password" id="password"/>
    <br /><br />
    <input type="submit" value="Σύνδεση" id="button" />
</form>
<?php if($result == -2) {
        echo "Το όνομα χρήστη ή ο κωδικός σας είναι λάθος, προσπαθήστε ξανά.";
        $result = null;
      }
?>
<br />
<h5> Δεν είστε μέλος; Πατήστε <span id="here"><a href='../views/register.php'>εδώ</a></span> για να εγγραφείτε. </h5>
</div>