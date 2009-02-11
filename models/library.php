<?
	function dbConnect() {
		require("config.php");
	
		$link = mysql_connect($DB_HOST, $DB_USER, $DB_PASS) 
			or die('Could not connect: ' . mysql_error());
		mysql_select_db($DB_NAME) 
			or die('Could not select database');
		return $link;
	}
	
	function dbDisconnect($link) {
		mysql_close($link);
	}
	
	//
	// Create Link function
	//
	function createLink($url) {
		$link = dbConnect();
	
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
		
		dbDisconnect($link);
		return dechex($resultArray["id"]);
	}
	
	//
	// Get Link function
	//
	function getLink($hash) {
		$link = dbConnect();
		
		//do our search
		$query = "SELECT url FROM urls where id = " . hexdec($hash) . ";";

		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		$resultArray = mysql_fetch_assoc($result);
	
		//cleanup our URL
		$url = stripslashes($resultArray["url"]);
		
		dbDisconnect($link);
		return $url;
	}
	
	//
	// Get Recent Links function
	//
	function getRecents($count) {
		$link = dbConnect();
	
		$recentShortens = array();
	
		$query = "SELECT id, url FROM urls ORDER BY id DESC LIMIT " . $count . ";";
		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	
		$i = 0;
		while ($resultArray = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$recentShortens[$i] = $resultArray;
			//add the hash too.
			$recentShortens[$i]["hash"] = dechex($resultArray["id"]);
			$i++;
		}
		
		dbDisconnect($link);
		return $recentShortens;
	}
	
?>