<?php /* controller/model */ ?>
<?php 
	require("models/library.php");
	$results = doSearch($_REQUEST['searchTerm']);
	require("views/search.php");
?>