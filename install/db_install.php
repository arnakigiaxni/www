<?php
    echo "<meta charset='UTF-8' />";
    
    mysql_connect("localhost", "root", "") or die(mysql_error());

    mysql_query("SET NAMES utf8");
    $db = mysql_query("CREATE DATABASE offers CHARSET=utf8 COLLATE utf8_general_ci");
    $sdb = mysql_select_db("offers");
    
    $company_table = mysql_query("CREATE TABLE company (
        id int(11) NOT NULL auto_increment,
	comp_name varchar(255) NOT NULL,
	display_name varchar(255) NOT NULL,
	password varchar(255) NOT NULL,
	address varchar(255) NOT NULL,
        city varchar(255) NOT NULL,
        postal_code int(11),
        phone int(11) NOT NULL,
        email varchar(255) NOT NULL,
        latitude double NOT NULL,
        longitude double NOT NULL,
	PRIMARY KEY(id)
	)ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;"); 

    $category_table = mysql_query("CREATE TABLE category (
        id int(11) NOT NULL,
        cat_name varchar(255) NOT NULL,
        PRIMARY KEY(id)
        )ENGINE=MyISAM DEFAULT CHARSET=utf8");
    
    $offer_table = mysql_query("CREATE TABLE offer (
        id int(11) NOT NULL auto_increment,
        comp_id int(11) NOT NULL,
        cat_id int(11) NOT NULL,
        offer_name varchar(255) NOT NULL,
        offer_descr varchar(255),
        start_date date NOT NULL,
        end_date date NOT NULL,
        discount double NOT NULL,
        price double NOT NULL,
        PRIMARY KEY (id)
        )ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;");
    
    $cat_insert = mysql_query("insert into category (id, cat_name)
	    VALUES (1, 'Τρόφιμα/Φαγητά'),
                   (2, 'Ποτά/Ροφήματα'),
                   (3, 'Καθαριστικά/Απορρυπαντικά'),
                   (4, 'Ρούχα/Παπούτσια'),
                   (5, 'Είγη υγιεινής')");

    if ($db && $sdb && $company_table && $category_table && $offer_table && $cat_insert) {
        echo "database & tables created successfully";
    }
    else {
        die("failed to create database & tables");
    }
    
    mysql_close ();
?>
