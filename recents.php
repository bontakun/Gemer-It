<?php /* controller/model */ ?>
<?php 
	require("library.php");
	
	$query = "SELECT id, url FROM urls ORDER BY id DESC LIMIT 20;";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());

	//push to view
	require("views/recents.php");
	
	mysql_close($link);
?>