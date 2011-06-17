<?php /* controller/model */ 
	$showId = $_REQUEST["showId"];
	
	require("models/library.php");
	$results = doSearch($_REQUEST['searchTerm']);
	
	if ($_REQUEST["format"] == "rss") {
		require("views/searchRss.php");
	} else if ($_REQUEST["format"] == "xml") {
		require("views/searchXML.php");
	} else {
		require("views/search.php");
	}
?>