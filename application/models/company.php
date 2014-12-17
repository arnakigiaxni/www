<?php
    function AuthenticateUser($username, $password){
        $result = mysql_query(
                "SELECT
                    id, display_name
                 FROM
                    company
                 WHERE
                    comp_name = '$username'
                    AND password = '$password'"
        );
        
        if (mysql_num_rows($result) == 1 ) {
            $userid = mysql_fetch_array($result);
            return $userid;
        }
        else {
            return false;
        }
    }
?>
