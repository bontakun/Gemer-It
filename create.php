<?php /* controller/model */ ?>
<?php
	require("models/library.php");
	
	$url = trim($_REQUEST["url"]);
	
	//check to see if they're giving us a gemerit link, first
	if (!(preg_match("/http:\/\/gemerit.com\/[0-9abcdef]+$/", $url)) && strlen($url) > 0) {
		
		//we're going to preppend http if they gave us a url that doesn't already have it
		if (!preg_match("/^https?:\/\//", $url))
			$url = "http://" . $url;
		
		//attempt shorten
		$hexCode = createLink($url);
		
		$url = "http://" . $_SERVER["SERVER_NAME"]  . "/" . $hexCode;
		
		//Special iPhone Twitterific integration pending more work
		if (stristr($_SERVER["HTTP_USER_AGENT"], "iPhone")) {
			$iphoneStuff = true;
		}
	}

	//push to view
	if (stristr($_REQUEST["format"], "text"))
		require("views/createSuccessPlain.php");
	else if (stristr($_REQUEST["format"], "xml"))
		require("views/createSuccessXML.php");
	else if (stristr($_REQUEST["format"], "JSON"))
		require("views/createSuccessJSON.php");	
	else
		require("views/createSuccess.php");
?>