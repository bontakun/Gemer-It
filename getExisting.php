<?php 
	require("models/library.php");
	$hash = getHexForURL($_REQUEST["url"]);
	if (strlen($hash > 0))
		echo("http://" . $_SERVER["SERVER_NAME"]  . "/" . $hash);
?>