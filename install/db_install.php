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
        phone varchar(255) NOT NULL,
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
    
	$about_table = mysql_query("CREATE TABLE about (
		ver_site varchar(255) NOT NULL,
		ver_ws varchar(255) NOT NULL
		)ENGINE=MyISAM DEFAULT CHARSET=utf8");
	
	$comp_insert = mysql_query("insert into company (id, comp_name, display_name, password, address, city, postal_code, phone, email, latitude, longitude)
		VALUES  (1, 'μασούτης', 'μασούτης', '12345', 'μακεδονομάχων 31', 'σέρρες', 62100, '2321038267', 'masoutis_serres@gmail.com', 40.41, 42.22),
				(2, 'carrefour', 'carrefour', '12345', 'φιλίππου 3', 'σέρρες', 62122, '2321056230', 'carrefour_serres@gmail.com', 38.72, 51.89),
				(3, 'κάντζας', 'κάντζας', '12345', 'μεραρχίας 64', 'σέρρες', 62100, '2321067544', 'kantzas_serres@gmail.com', 45.66, 43.21)");
	
    $cat_insert = mysql_query("insert into category (id, cat_name)
	    VALUES (1, 'Τρόφιμα/Φαγητά'),
               (2, 'Ποτά/Ροφήματα'),
               (3, 'Καθαριστικά/Απορρυπαντικά'),
               (4, 'Ρούχα/Παπούτσια'),
               (5, 'Είγη υγιεινής')");
				   
	$offer_insert = mysql_query("insert into offer (id, comp_id, cat_id, offer_name, offer_descr, start_date, end_date, discount, price)
		VALUES  (1, 1, 1, 'αλλαντικά', '30% φθηνότερα', '2014-11-01', '2014-12-01', 30, 5),
				(2, 1, 1, 'λευκά τυριά', 'μόνο 4,50€ το κιλό', '2014-06-05', '2015-01-01', 27, 6.16),
				(3, 2, 1, 'σοκολάτες', '20% φθηνότερα', '2014-08-01', '2015-03-21', 20, 1.5),
				(4, 3, 2, 'αναψηκτικά', '40% φθηνότερα', '2014-10-04', '2014-12-08', 40, 1),
				(5, 3, 3, 'απορρυπαντικά', '50% φθηνότερα', '2014-11-15', '2015-10-03', 50, 10)");
			
	
	$about_insert = mysql_query("insert into about (ver_site, ver_ws) VALUES ('ver 0.2', 'ver 0.2')");
	
    if ($db && $sdb && $company_table && $category_table && $offer_table && $about_table && $comp_insert && $cat_insert && $offer_insert && $about_insert) {
        echo "database & tables created successfully";
    }
    else {
        die("failed to create database & tables");
    }
    
    mysql_close ();
?>
