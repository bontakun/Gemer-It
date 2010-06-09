<?php
	require("models/library.php");
	$results = getLinkInfo($_REQUEST["hash"]);
	require("views/about.php");
?>