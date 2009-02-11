<?php
	require("models/library.php");

	$url = getLink($_REQUEST["hash"]);

	//check for attempt at making a loop, this is the only hardcoded url in the project
	if (!(preg_match("/gemerit\.com\/[0-9abcdef]+$/", $url)))
		header( 'Location: ' . $url, true);
	else
		echo($url);
?>