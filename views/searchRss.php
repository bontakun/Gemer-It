<?php /* view */ ?>
<?php header("Content-Type: application/rss+xml "); ?>
<rss version="2.0">
<channel> 
	<title>Gemer It <?php if ($_REQUEST["searchTerm"]) { echo("Recent Items That Match the Search term " . $_REQUEST["searchTerm"]); } else { echo("Recent Links"); } ?></title>     
	<link>http://gemerit.com</link> 
	<description>Gemer RSS Feed, completely customizable with search terms.</description> 
<?php		
		for ($i = 0; $i < sizeof($results); $i++) {
			$result = $results[$i];
			require("aboutRowRss.php");
		}
?>
</channel>
</rss>