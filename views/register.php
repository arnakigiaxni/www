<?php
    include_once "../includes/register.inc.php";
    include_once "../includes/functions.php";
    include_once "../js/google_maps/gmaps_helper.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel='stylesheet' type='text/css' href='../css/style.css' />
        <title>Φόρμα εγγραφής καταστήματος</title>
    </head>
    
    <body>
       <p><span class='error'>* Απαραίτητο πεδίο</span></p>
       <form method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'>  
            Όνομα χρήστη: <input type='text' name='comp_name' maxlength='20' 
                <?php echo "value='$comp_name'"; ?>/>
            <span class='error'>* <?php echo $comp_nameError; ?></span>
            <br />
            <br />
            Επωνυμία καταστήματος: <input type='text' name='display_name' maxlength='20' 
                <?php echo "value='$display_name'"; ?>/>                                          
            <span class='error'>* <?php echo $display_nameError; ?></span>            
            <br />
            <br />
            Κωδικός: <input type='password' name='password' maxlength='20'
                <?php echo "value='$password'"; ?>/>                            
            <span class='error'>* <?php echo $passwordError; ?></span> 
            <br />
            <br />
            E-mail: <input type='text' name='email' maxlength='25'
                <?php echo "value='$email'"; ?>/>                           
            <span class='error'>* <?php echo $emailError; ?></span>
            <br />
            <br />
            Πόλη: <input type='text' name='city' maxlength='25' 
                <?php echo "value='$city'"; ?> />                         
            <span class='error'>* <?php echo $cityError; ?></span>
            <br />
            <br />
            Διεύθυνση: <input type='text' name='address' maxlength='25' 
                <?php echo "value='$address'"; ?> />                              
            <span class='error'>* <?php echo $addressError; ?></span>
            <br />
            <br />  
            Ταχυδρομικός κώδικας: <input type='text' name='postal_code' maxlength='5' 
                <?php echo "value='$postal_code'"; ?> />                                         
            <span class='error'> <?php echo $postal_codeError; ?></span>
            <br />
            <br /> 
            Τηλέφωνο: <input type='text' name='phone' maxlength='10' 
                <?php echo "value='$phone'"; ?> />                             
            <span class='error'>* <?php echo $phoneError; ?></span>            
            <br />
            <br />
            <a href="../js/google_maps/gmaps.php" onclick="window.open(this.href, 'gmaps',
                'width=1000,height=600'); return false;" >gmaps</a> //under construction
            <br />
            <br />

            <br />
            <br />

            <br />
            <br />
            <input type='submit' value='Εγγραφή'/>
            <br />
            <span class='success'><?php echo $successful_register; ?></span>
            <br />
            <h5>Είστε ήδη εγγεγραμμένος; Πατήστε <a href='index.php'>εδώ</a> για να συνδεθείτε.</h5>
       </form>
    </body>
</html>

