<?php
	require("models/library.php");
	$results = getLinkInfo($_REQUEST["hash"]);
	$showId = true;
	require("views/about.php");
?>