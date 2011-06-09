<?php
	/* controller/model */
	require("models/library.php");
	
	//pull out whitespace
	$url = trim($_REQUEST["url"]);
	
	//this is a harded removal check for ietab, since many users use it, we'll account for it on creation (for now)
	$url = str_ireplace("http://chrome://ietab/content/reloaded.html?url=", "", $url);
	
	//check to see if they're giving us a gemerit link, first
	if (validateLink($url)) {
		
		//we're going to preppend http if they gave us a url that doesn't already have it
		if (!preg_match("/^https?:\/\//", $url))
			$url = "http://" . $url;
		
		//attempt shorten
		$hexCode = createLink($url, $_REQUEST["title"]);
		
		$url = "http://" . $_SERVER["SERVER_NAME"]  . "/" . $hexCode;
	}

	//push to view
	if (stristr($_REQUEST["format"], "text"))
		require("views/createSuccessPlain.php");
	else if (stristr($_REQUEST["format"], "xml"))
		require("views/createSuccessXML.php");
	else if (stristr($_REQUEST["format"], "JSON"))
		require("views/createSuccessJSON.php");	
	//else if (stristr($_SERVER["HTTP_USER_AGENT"], "iPhone") || stristr($_SERVER["HTTP_USER_AGENT"], "Android"))
	//	require("views/createSuccessMobile.php");
	else if (stristr($_REQUEST["format"], "thin"))
		require("views/createSuccessThin.php");
	else
		require("views/createSuccess.php");
		
	function validateLink($url) {
		//checking string for content
		if (strlen($url) == 0) 
			return false;
			//checking recursion, basic check
		if (preg_match("/^http:\/\/([wW]{3}\.)?gemerit.com\/(([0-9abcdef]+)|(x[a-zA-Z0-9]+))$/", $url)) 
			return false;
		//doing a basic check to make sure it looks like a url
		if (!preg_match("/^(https?:\/\/)?[^.]+\.[a-zA-Z]{2,3}(\.[a-zA-Z]{2})?\/?.*$/mi", $url))
			return false;
		return checkForBadLink($url);
	}
?>