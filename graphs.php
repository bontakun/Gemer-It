<?php 
	require("models/library.php");
	
	$days = getTotalCountsByDay();
	
	require("views/graphs.php");
?>