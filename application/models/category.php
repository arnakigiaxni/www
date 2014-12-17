<?php
    function ShowCategories() {
        $return = mysql_query(
                "SELECT
                    *
                FROM
                    category
                ORDER BY
                    cat_name"                
        );
        while ($categories = mysql_fetch_array($return) ) {
			echo '<option value="' . $categories['id'] . '">' . $categories[ 'cat_name' ] . '</option>';
        }
    }
?>
