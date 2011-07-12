<?php
	require("models/library.php");

	if ($_COOKIE["previewUrl"] == "true") {
		$url = "http://" . $_SERVER["SERVER_NAME"] . "/about/" . $_REQUEST["hash"];
	} else {
		if ($_REQUEST["new"])
			$url = getLink($_REQUEST["hash"], true);
		else
			$url = getLink($_REQUEST["hash"], false);
	}
	if ($url)
		header( 'Location: ' . $url, true);
	else 
		header( 'Location: /error.php', true);
?>