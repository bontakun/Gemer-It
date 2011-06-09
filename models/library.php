<?
	function getDbConnect() {
		require("config.php");
		return new PDO('mysql:host='.$DB_HOST.';dbname='. $DB_NAME, $DB_USER, $DB_PASS);
	}
	
	//
	// Create Link function
	//
	function createLink($url, $title) {
		$link = getDbConnect();
	
		//attempt to retrieve the item
		$preparedStatement = $link->prepare("SELECT id FROM urls WHERE url LIKE :url;");
		$preparedStatement->execute(array(":url" => $url));
		$results = $preparedStatement->fetchAll();
		
		//if it's not there we need to insert and retrieve
		if (count($results) > 0) {
			return getHashCode($results[0]["id"]);
		} else {
			//insert
			$preparedStatement = $link->prepare("INSERT INTO urls (url, creationDate, ip, title) VALUES (:url, :modTime, :ip, :title);");
			$preparedStatement->execute(array(
				":url" => $url, 
				":modTime" => time(), 
				":ip" => $_ENV["REMOTE_ADDR"], 
				":title" => $title));
			
			$preparedStatement = $link->prepare("SELECT id FROM urls WHERE url LIKE :url;");
			$preparedStatement->execute(array(":url" => $url));
			$results = $preparedStatement->fetchAll();
			return getHashCode($results[0]["id"]);
		}
	}
	
	//
	// Get Link function
	//
	function getLink($hash, $newHash) {
		$link = getDbConnect();
	
		//get the id
		if ($newHash) 
			$id = base_convert($hash, 36, 10);
		else
			$id = hexdec($hash);

		//do our search
		$preparedStatement = $link->prepare("SELECT url FROM urls WHERE id LIKE :id;");
		$preparedStatement->execute(array(":id" => $id));
		$results = $preparedStatement->fetchAll();
	
		//cleanup our URL
		$url = stripslashes($results[0]["url"]);
		
		$query = "UPDATE urls SET visits = visits+1 WHERE id = " . $id;
		$preparedStatement = $link->prepare("UPDATE urls SET visits = visits+1 WHERE id LIKE :id;");
		$preparedStatement->execute(array(":id" => $id));
		
		return $url;
	}
	
	//
	// This gets every piece of info about a given link
	//
	function getLinkInfo($hash) {
		$link = getDbConnect();
	
		//get the id
		$id = base_convert($hash, 36, 10);

		//do our search
		$preparedStatement = $link->prepare("SELECT * FROM urls WHERE id LIKE :id;");
		$preparedStatement->execute(array(":id" => $id));
		return parseFullResults($preparedStatement->fetchAll());
	}
	
	//
	// Get Recent Links function
	//
	function getRecents() {
		$link = getDbConnect();
		$preparedStatement = $link->prepare("SELECT * FROM urls ORDER BY id DESC LIMIT 50;");
		$preparedStatement->execute(array(":count" => $count));
		return parseFullResults($preparedStatement->fetchAll());
	}
	
	//
	//
	//
	function getTopLinks() {
		$link = getDbConnect();
		$preparedStatement = $link->prepare("SELECT * FROM urls ORDER BY visits DESC LIMIT 50;");
		$preparedStatement->execute(array(":count" => $count));
		return parseFullResults($preparedStatement->fetchAll());
	}
	
	//
	// This function performs a search on the database
	//
	function doSearch($searchTerm) {
		if (strlen($searchTerm) > 0) {		
			$link = getDbConnect();
			$preparedStatement = $link->prepare("SELECT * FROM urls WHERE url LIKE :searchTerm OR title LIKE :searchTerm OR ip LIKE :searchTerm ORDER BY id DESC LIMIT 50;");
			$preparedStatement->execute(array(":searchTerm" => "%$searchTerm%"));
			return parseFullResults($preparedStatement->fetchAll());
		} else {
			return getRecents();
		}
	}
	
	function parseFullResults($results) {
		for ($i = 0; $i < count($results); $i++) {
			$results[$i]["hash"] = getHashCode($results[$i]["id"]);
			$results[$i]["title"] = stripslashes($results[$i]["title"]);
		}
		return $results;
	}
	
	function checkForBadLink($url) {
		$link = getDbConnect();
		$preparedStatement = $link->prepare("select hash from google_safe_browsing where hash = :hash;");
		$preparedStatement->execute(array(":hash" => md5($url)));
		return count($preparedStatement->fetchAll()) == 0;
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