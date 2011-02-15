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
	function createLink($url, $title) {
		$title = preg_replace("/[']+/im", "", trim($title));
	
		$link = dbConnect();
	
		//attempt to retrieve the item
		$query = "SELECT id FROM urls WHERE url = '" . 
				addslashes($url) . "';";
		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		
		//if it's not there we need to insert and retrieve
		if (mysql_num_rows($result) == 0) {
			//insert
			$query = "INSERT INTO urls (url, creationDate, ip, title) VALUES ('" . 
				addslashes($url) . "', " . time() .  ", '" . $_ENV["REMOTE_ADDR"] . "', '" . 
				$title . "');";
			mysql_query($query) or die('Query failed: ' . mysql_error());
			
			//get back the thing we just inserted
			$query = "SELECT id FROM urls WHERE url = '" . 
				addslashes($url) . "';";
			$result = mysql_query($query) or die('Query failed: ' . mysql_error());	
		}
		
		//get results in easy to use array format
		$resultArray = mysql_fetch_assoc($result);
		
		dbDisconnect($link);
		return getHashCode($resultArray["id"]);
	}
	
	//
	// Get Link function
	//
	function getLink($hash, $newHash) {
		$link = dbConnect();
	
		//get the id
		if ($newHash) 
			$id = base_convert($hash, 36, 10);
		else
			$id =  hexdec($hash);

		//do our search
		$query = "SELECT url FROM urls WHERE id = " . $id . ";";
		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		$resultArray = mysql_fetch_assoc($result);
	
		//cleanup our URL
		$url = stripslashes($resultArray["url"]);
		
		$query = "UPDATE urls SET visits = visits+1 WHERE id = " . $id;
		mysql_query($query);
		
		dbDisconnect($link);
		return $url;
	}
	
	//
	// This gets every piece of info about a given link
	//
	function getLinkInfo($hash) {
		$link = dbConnect();
	
		//get the id
		$id = base_convert($hash, 36, 10);

		//do our search
		$query = "SELECT * FROM urls WHERE id = " . $id . ";";
		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		$results = parseFullResults($result);
		
		dbDisconnect($link);
		return $results;
	}
	
	//
	// Get Recent Links function
	//
	function getRecents($count) {
		$link = dbConnect();
	
		$query = "SELECT * FROM urls ORDER BY id DESC LIMIT " . $count . ";";
		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		$recentShortens = parseFullResults($result);
		
		dbDisconnect($link);
		return $recentShortens;
	}
	
	//
	// This function duplicates code with createLink, need to fix that,
	// also this name is not final, it really should be tweaked.
	//
	function getHexForURL($url) {
		$link = dbConnect();
		
		$query = "SELECT id FROM urls WHERE url = '" . 
				addslashes($url) . "';";
		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		
		if (mysql_num_rows($result) > 0) {
			$resultArray = mysql_fetch_assoc($result);
			dbDisconnect($link);
			return getHashCode($resultArray["id"]);
		}
		else {
			dbDisconnect($link);
			return "";
		}
	}
	
	//
	// This get the top links and is organized by day
	//
	function getTotalCountsByDay() {
		$link = dbConnect();
		
		$dateArray = array();
		
		$query = "SELECT creationDate FROM urls WHERE creationDate > 0;";
		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		
		while($resultArray = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$dateString = strtotime(date("F j, Y", $resultArray["creationDate"]));
			$dateArray[$dateString] = $dateArray[$dateString] + 1;
		}
		
		dbDisconnect($link);
		return $dateArray;
	}
	
	//
	//
	//
	function getTopLinks($count) {
		$link = dbConnect();
		
		$resultsArray = array();
		
		$query = "SELECT * FROM urls ORDER BY visits DESC LIMIT " . $count . ";";
		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		$resultsArray = parseFullResults($result);
		
		dbDisconnect($link);
		return $resultsArray;
	}
	
	//
	// This function performs a search on the database
	//
	function doSearch($searchTerm) {
		$searchTerm = preg_replace("/[']+/im", "", trim($searchTerm));
		$resultsArray = array();
		
		if (strlen($searchTerm) > 0) {		
			$link = dbConnect();
			
			$query = "SELECT * FROM urls WHERE url LIKE '%" . $searchTerm . "%' OR title LIKE '%" . $searchTerm ."%' OR ip LIKE '%" . $searchTerm . "%' ORDER BY id DESC LIMIT 50;" ;
			$result = mysql_query($query) or die('Query failed: ' . mysql_error());
			$resultsArray = parseFullResults($result);
			
			dbDisconnect($link);
		} else {
			$resultsArray = getRecents(30);
		}
		return $resultsArray;		
	}
	
	function parseFullResults($result) {
		$resultsArray = array();
		$i = 0;
		while ($resultArray = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$resultsArray[$i] = $resultArray;
			$resultsArray[$i]["hash"] = getHashCode($resultArray["id"]);
			$i++;
		}
		return $resultsArray;
	}
	
	function checkForBadLink($url) {
		$link = dbConnect();
		$query = "select hash from google_safe_browsing where hash = '" . md5($url) .  "'";
		$result = mysql_query($query) or die('Query failed: ' . mysql_error());
		$returnValue = mysql_num_rows($result) == 0;
		dbDisconnect($link);
		return $returnValue;
	}
	
	function getHashCode($id) {
		return "x" . base_convert($id, 10, 36);
	}
	
	function getId($hash) {
		return base_convert($hash, 36, 10);
	}
	
	function xml_entities($text, $charset = 'UTF-8'){
		$xml_special_chars = array("&quot;","&amp;","&apos;","&lt;","&gt;");
    $text = htmlentities($text, ENT_COMPAT, $charset, false);

    $xml_special_char_regex = "(?";
    foreach($xml_special_chars as $key => $value){
        $xml_special_char_regex .= "(?!$value)";
    }
    $xml_special_char_regex .= ")";
    
    $pattern = "/$xml_special_char_regex&([a-zA-Z0-9]+;)/";
    return preg_replace($pattern, '&amp;${1}', $text);
}
	
?>