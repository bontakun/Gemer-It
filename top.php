<?php
	/* controller/model */
	require("models/library.php");
	$results = getTopLinks(50);
	require("views/top.php");
?>