<?php    
	$link = mysql_connect("localhost", "root", "27188");
	if(!$link) {
		die("Could not connect to host");
	}
	
	$seldb = mysql_select_db("offers");
	if(!$seldb) {
		die("Could not connect to database");
	}
?>
