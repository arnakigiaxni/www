<?php
    include_once '../config/db_connect.php';
    include_once '../controllers/home_controller.php';
    mysql_query("SET NAMES utf8");
    if(!isset($_SESSION['id'])) {
        header( "Location: ../controllers/index.php" );
    }    
?>

<div id="home">
    <br />
    <br />
    <div id='home_body'>
    <?php
        $offers = new ShowOffers();
        $result = $offers->show();
        if ($result !== false)
        {
            echo "
            <p>Οι τελευταίες σας καταχωρήσεις</p>
            <table>
                <tr>
                    <th>
                            Προσφορά
                    </th>
                    <th>
                            Περιγραφή
                    </th>
                    <th>
                            Τιμή
                    </th>
                    <th>
                            Έκπτωση
                    </th>
                    <th>
                            Έναρξη
                    </th>
                    <th>
                            Λήξη
                    </th>
                </tr> ";
                while($row=mysql_fetch_array($result)) {
                    echo
                    "<tr>
                    <td>".$row["offer_name"]."</td>
                    <td>".$row["offer_descr"]."</td>
                    <td>".$row["price"]." €</td>
                    <td>".$row["discount"]." %</td>
                    <td>".$row["start_date"]."</td>
                    <td>".$row["end_date"]."</td>
                    </tr>";
                }
                echo "
            </table>";
        }
        else
        {
            echo "<p>Δεν έχετε καταχωρημένες προσφορές</p>";
        }
    ?>
    </div>
</div>
