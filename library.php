<?php 
	$DB_USER = "database username";
	$DB_PASS = "super secret password";
	$DB_HOST = "database server";
	$DB_NAME = "database name";
	
	$link = mysql_connect($DB_HOST, $DB_USER, $DB_PASS) 
		or die('Could not connect: ' . mysql_error());
	mysql_select_db($DB_NAME) 
		or die('Could not select database');
?>