<?php
	require("library.php");

	//do our search
	$query = "SELECT url FROM urls where id = " . hexdec($_REQUEST["hash"]) . ";";

	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	$resultArray = mysql_fetch_assoc($result);
	
	//cleanup our URL
	$url = stripslashes($resultArray["url"]);

	//check for attempt at making a loop, this is the only hardcoded url in the project
	if (!(preg_match("/gemerit\.com\/[0-9abcdef]+$/", $url)))
		header( 'Location: ' . $url, true);
	else
		echo($url);
	mysql_close($link);
?>