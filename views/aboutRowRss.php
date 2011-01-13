<item> 
	<title><?php 
		if ($result["title"]) { 
			echo(xml_entities($result["title"])); 
		} else { 
			echo("http://gemerit.com/" .$result["hash"]); 
		} ?></title>         
	<link>http://gemerit.com/<?php echo($result["hash"]); ?></link> 
	<description><?php echo(xml_entities($result["url"])); 
if(eregi(".*(\.jpg|\.gif|\.png|\.jpeg)$", $result["url"])) { ?>
  	&lt;img src="<?php echo(xml_entities($result["url"])); ?>"&gt;
	<?php } ?></description>
	<pubDate><?php echo(date(DATE_RSS, $result["creationDate"])); ?></pubDate>
</item>