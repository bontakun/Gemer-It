<?php /* controller/model */ ?>
<?php 
	require("models/library.php");
	
	$recents = getRecents(50);

	//push to view
	if(stristr($_SERVER["HTTP_USER_AGENT"], "iPhone"))
		require("views/recentsMobile.php");
	else
		require("views/recents.php");
?>