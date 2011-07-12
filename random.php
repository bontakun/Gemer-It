<?php
	require("models/library.php");
	$link = getRandomLink();

	if ($_COOKIE["previewUrl"] == "true") {
		$url = "http://" . $_SERVER["SERVER_NAME"] . "/about/" . $link[0]["hash"];
	} else {
		$url = $link[0]["url"];
	}
	
	header( 'Location: ' . $url, true);
?>