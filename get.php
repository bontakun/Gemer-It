<?php
	require("models/library.php");

	$url = getLink($_REQUEST["hash"]);
	header( 'Location: ' . $url, true);
?>