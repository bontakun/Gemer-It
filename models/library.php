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
			$query = "INSERT INTO urls (url, creationDate, ip) VALUES ('" . 
				addslashes($url) . "', " . time() .  ", '" . $_ENV["REMOTE_ADDR"] . "');";
			mysql_query($query) or die('Query failed: ' . mysql_error());
			
			//get back the thing we just inserted
			$query = "SELECT id FROM urls where url = '" . 
				addslashes($url) . "';";
			$result = mysql_query($query) or die('Query failed: ' . mysql_error());	
		}
		
		//get results in easy to use array format
		$resultArray = mysql_fetch_assoc($result);
		
		dbDisconnect($link);
		return "x" . base_convert($resultArray["id"], 10, 36);
	}
	
	//
	// Get Link function
	//
	function getLink($hash, $newHash) {
		$link = dbConnect();
		
		//do our search
		if ($newHash) 
			$query = "SELECT url FROM urls where id = " . base_convert($hash, 36, 10) . ";";
		else
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
	
		$query = "SELECT id, url, creationDate FROM urls ORDER BY id DESC LIMIT " . $count . ";";
		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	
		$i = 0;
		while ($resultArray = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$recentShortens[$i] = $resultArray;
			//add the hash too.
			$recentShortens[$i]["hash"] = "x" . base_convert($resultArray["id"], 10, 36);;
			$i++;
		}
		
		dbDisconnect($link);
		return $recentShortens;
	}
	
	function getRecentsByIp($count) {
		$link = dbConnect();
	
		$recentShortens = array();
	
		$query = "SELECT id, url, creationDate FROM urls WHERE ip = '" . $_ENV["REMOTE_ADDR"] . "' ORDER BY id DESC LIMIT " . $count . ";";
		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	
		$i = 0;
		while ($resultArray = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$recentShortens[$i] = $resultArray;
			//add the hash too.
			$recentShortens[$i]["hash"] = "x" . base_convert($resultArray["id"], 10, 36);;
			$i++;
		}
		
		dbDisconnect($link);
		return $recentShortens;	
	}
	
	//
	// This function duplicates code with createLink, need to fix that,
	// also this name is not final, it really should be tweaked.
	//
	function getHexForURL($url) {
		$link = dbConnect();
		
		$query = "SELECT id FROM urls where url = '" . 
				addslashes($url) . "';";
		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		
		if (mysql_num_rows($result) > 0) {
			$resultArray = mysql_fetch_assoc($result);
			dbDisconnect($link);
			return "x" . base_convert($resultArray["id"], 10, 36);;
		}
		else {
			dbDisconnect($link);
			return "";
		}
	}
	
	function getTotalCountsByDay() {
		$link = dbConnect();
		
		$dateArray = array();
		
		$query = "SELECT creationDate FROM urls where creationDate > 0;";
		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		
		while($resultArray = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$dateString = strtotime(date("F j, Y", $resultArray["creationDate"]));
			$dateArray[$dateString] = $dateArray[$dateString] + 1;
		}
		
		dbDisconnect($link);
		return $dateArray;
	}
?>