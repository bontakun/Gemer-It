<?php 
	if(stristr($_SERVER["HTTP_USER_AGENT"], "iPhone"))
		require("views/indexMobile.php");
	else
		require("views/index.php");
?>