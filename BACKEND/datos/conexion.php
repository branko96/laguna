<?php

	$dbhost = 'localhost';
	$dbuser = 'c1520705_perros';
	$dbpass = 'Perros2019';
	$dbname = 'c1520705_laguna';

	$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Ocurrio un error al conectarse al servidor mysql');
	mysql_select_db($dbname);
?>