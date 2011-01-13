	<gemerLink>
		<title><?php 
			if ($result["title"]) { 
				echo(xml_entities($result["title"])); 
			} else { 
				echo("http://gemerit.com/" . $result["hash"]); 
			} ?></title>
		<shortUrl>http://gemerit.com/<?php echo($result["hash"]); ?></shortUrl>
		<visits><?php echo($result["visits"]) ?></visits>
		<creationDate><?php echo($result["creationDate"]) ?></creationDate>
		<longUrl><?php echo(xml_entities($result["url"])) ?></longUrl>
	</gemerLink>