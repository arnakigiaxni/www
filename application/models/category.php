<?php

    mysql_query("SET NAMES utf8");
    
    function ShowCategories($cat_id) {
        if ($cat_id != NULL){
            $return = mysql_query(
                "SELECT
                    *
                FROM
                    category
                WHERE
                    id = '$cat_id'"
            ); 
            while ($categories = mysql_fetch_array($return) ) {
		echo '<option value="' . $categories['id'] . '">' . $categories[ 'cat_name' ] . '</option>';
            }
        }
        $return = mysql_query(
                "SELECT
                    *
                FROM
                    category
                WHERE
                    id != '$cat_id'
                ORDER BY
                    cat_name"                
        );
        while ($categories = mysql_fetch_array($return) ) {
			echo '<option value="' . $categories['id'] . '">' . $categories[ 'cat_name' ] . '</option>';
        }
    }
?>
