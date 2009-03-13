<?php /* controller/model */ ?>
<?php 
	require("models/library.php");
	
	$recents = getRecents(30);

	//push to view
	require("views/recents.php");
?>