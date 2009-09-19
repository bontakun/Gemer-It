<?php
	require("models/library.php");

	if ($_REQUEST["new"])
		$url = getLink($_REQUEST["hash"], true);
	else
		$url = getLink($_REQUEST["hash"], false);
	header( 'Location: ' . $url, true);
?>