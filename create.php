<?php /* controller/model */ ?>
<?php
	require("library.php");
	
	$url = trim($_REQUEST["url"]);
	
	//check to see if they're giving us a gemerit link, first
	if (!(preg_match("/http:\/\/gemerit.com\/[0-9abcdef]+$/", $url))) {
		
		//we're going to preppend http if they gave us a url that doesn't already have it
		if (!preg_match("/^https?:\/\//", $url))
			$url = "http://" . $url;
		
		//attempt to retrieve the item
		$query = "SELECT id FROM urls where url = '" . 
				addslashes($url) . "';";
		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		
		//if it's not there we need to insert and retrieve
		if (mysql_num_rows($result) == 0)
		{
			//insert
			$query = "INSERT INTO urls (url) VALUES ('" . 
				addslashes($url) . "');";
			mysql_query($query) or die('Query failed: ' . mysql_error());
			
			//get back the thing we just inserted
			$query = "SELECT id FROM urls where url = '" . 
				addslashes($url) . "';";
			$result = mysql_query($query) or die('Query failed: ' . mysql_error());	
		}
		
		//get results in easy to use array format
		$resultArray = mysql_fetch_assoc($result);
		
		$url = "http://" . $_SERVER["SERVER_NAME"]  . "/" . dechex($resultArray["id"]);
		
		//Special iPhone Twitterific integration pending more work
		if (stristr($_SERVER["HTTP_USER_AGENT"], "iPhone")) {
			$iphoneStuff = true;
		}
	}

	//push to view
	require("views/createSuccess.php");

	mysql_close($link);
?>