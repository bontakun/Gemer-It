<?
	//
	// This forms a connection to the database
	//
	function getDbConnect() {
		require("config.php");
		return new PDO('mysql:host='.$DB_HOST.';dbname='. $DB_NAME, $DB_USER, $DB_PASS);
	}
	
	//
	// This function creates a shortened version of a link, it will reuse and existing link if possible.
	//
	function createLink($url, $title) {
		$link = getDbConnect();
	
		//attempt to retrieve the item
		$preparedStatement = $link->prepare("SELECT id FROM urls WHERE url = :url;");
		$preparedStatement->execute(array(":url" => $url));
		$results = $preparedStatement->fetchAll();
		
		//if it's not there we need to insert and retrieve
		if (count($results) > 0) {
			return getHashCode($results[0]["id"]);
		} else {
			//insert
			$preparedStatement = $link->prepare("INSERT INTO urls (url, creationDate, ip, title) VALUES (:url, :modTime, :ip, :title);");
			$preparedStatement->execute(array(
				":url" => $url, ":modTime" => time(), 
				":ip" => $_ENV["REMOTE_ADDR"], ":title" => $title)); 
			checkForDbError($preparedStatement);

			$preparedStatement = $link->prepare("SELECT id FROM urls WHERE url = :url;");
			$preparedStatement->execute(array(":url" => $url));
			$results = $preparedStatement->fetchAll();
			return getHashCode($results[0]["id"]);
		}
	}
	
	//
	// This function retrieves the url for a hash and updates the visits count.
	//
	function getLink($hash, $newHash) {
		$link = getDbConnect();
	
		//get the id
		if ($newHash) 
			$id = base_convert($hash, 36, 10);
		else
			$id = hexdec($hash);

		//do our search
		$preparedStatement = $link->prepare("SELECT url FROM urls WHERE id = :id;");
		$preparedStatement->execute(array(":id" => $id));
		$results = $preparedStatement->fetchAll();
	
		//cleanup our URL
		$url = stripslashes($results[0]["url"]);
		
		$preparedStatement = $link->prepare("UPDATE urls SET visits = visits+1 WHERE id = :id;");
		$preparedStatement->execute(array(":id" => $id));
		return $url;
	}
	
	//
	// This function takes a hash code and retrieves all data on that link.
	//
	function getLinkInfo($hash) {
		$link = getDbConnect();
	
		//get the id
		$id = base_convert($hash, 36, 10);

		//do our search
		$preparedStatement = $link->prepare("SELECT * FROM urls WHERE id = :id;");
		$preparedStatement->execute(array(":id" => $id));
		return parseFullResults($preparedStatement->fetchAll());
	}
	
	//
	// This function returns the 30 most recently created links.
	//
	function getRecents() {
		$link = getDbConnect();
		$preparedStatement = $link->prepare("SELECT * FROM urls ORDER BY id DESC LIMIT 30;");
		$preparedStatement->execute(array());
		return parseFullResults($preparedStatement->fetchAll());
	}
	
	//
	// This function returns the 50 most clicked onlinks.
	//
	function getTopLinks() {
		$link = getDbConnect();
		$preparedStatement = $link->prepare("SELECT * FROM urls ORDER BY visits DESC LIMIT 50;");
		$preparedStatement->execute(array());
		return parseFullResults($preparedStatement->fetchAll());
	}
	
	//
	// This function performs a search on the database.
	// If no search term provided it returns the top 30 recent results.
	//
	function doSearch($searchTerm) {
		if (strlen($searchTerm) > 0) {		
			$link = getDbConnect();
			$preparedStatement = $link->prepare("SELECT * FROM urls WHERE url LIKE :searchTerm OR title LIKE :searchTerm OR ip LIKE :searchTerm ORDER BY id DESC LIMIT 50;");
			$preparedStatement->execute(array(":searchTerm" => "%$searchTerm%"));
			checkForDbError($preparedStatement);
			return parseFullResults($preparedStatement->fetchAll());
		} else {
			return getRecents();
		}
	}
	
	//
	// This function retrieves a random element
	//
	function getRandomLink() {
		$link = getDbConnect();
		$preparedStatement = $link->prepare("SELECT * FROM urls ORDER BY RAND() LIMIT 1;");
		$preparedStatement->execute(array());
		return parseFullResults($preparedStatement->fetchAll());
	}
	
	//
	// Parses the results, corrects and adds elemeents as needed.
	//
	function parseFullResults($results) {
		for ($i = 0; $i < count($results); $i++) {
			$results[$i]["hash"] = getHashCode($results[$i]["id"]);
			$results[$i]["title"] = stripslashes($results[$i]["title"]);
		}
		return $results;
	}
	
	//
	// This checks the google safe browsing cacheto see if the link is good.
	//
	function checkForBadLink($url) {
		$link = getDbConnect();
		$preparedStatement = $link->prepare("select hash from google_safe_browsing where hash = :hash;");
		$preparedStatement->execute(array(":hash" => md5($url)));
		return count($preparedStatement->fetchAll()) == 0;
	}
	
	//
	// this converts a numeric id into an extended range hashcode.
	//
	function getHashCode($id) {
		return "x" . base_convert($id, 10, 36);
	}
	
	//
	// This converts a hash code into a numberic id.
	//
	function getId($hash) {
		return base_convert($hash, 36, 10);
	}
	
	//
	// This checks the prepared statement for errors
	// and force a page failure if an error exists.
	//
	function checkForDbError($preparedStatement) {
			$error = $preparedStatement->errorInfo();
			if ($error != null && count($error) > 0 && $error[0] > 0)
				die("Insert failed on: $error[2]");
	}
	
	//
	// This is a method that had no other home, it's a simple method
	// to xml encode the contents.
	//
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