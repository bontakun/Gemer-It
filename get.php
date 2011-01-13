<?php
	require("models/library.php");

	if ($_COOKIE["previewUrl"] == "true") {
		$url = "http://gemerit.com/about/" . $_REQUEST["hash"];
	} else {
		if ($_REQUEST["new"])
			$url = getLink($_REQUEST["hash"], true);
		else
			$url = getLink($_REQUEST["hash"], false);
	}
	header( 'Location: ' . $url, true);
?>