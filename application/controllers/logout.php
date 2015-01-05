<?php
    mysql_query("SET NAMES utf8");
    session_start();
    unset( $_SESSION[ 'id' ] );
    header( 'Location: index.php' );
?>