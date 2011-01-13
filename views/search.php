<?php /* view */ ?>
<html>
	<head>
		<title>Gemer It: Search</title>
		<link rel="stylesheet" type="text/css" href="style/global.css" />
		<meta name="viewport" content="width=630" />
		<link rel="alternate" type="application/rss+xml"  href="http://gemerit.com/search.rss<?php if ($_REQUEST["searchTerm"]) { echo("?searchTerm=".$_REQUEST["searchTerm"]); } ?>" title="RSS feed of this search items">
	</head>
	<body>
	<?php require("settings.php"); ?>
	<div class="container">
		<h2>Gemer It Search</h2>
		
		<form name="gemerForm" method="get" action="search.php">
			<span>Search Term: </span>
			<input type="search" size="72" autofocus placeholder="put search terms in here" name="searchTerm" value="<?php echo($_REQUEST["searchTerm"]); ?>">
			<input type="submit" value="Search">
		</form>
		
<?php 
		if (strlen(trim($_REQUEST["searchTerm"])) == 0) { 
?> 
		<p>The default results below are the recently created links.</p>
<?php		
		}
		require("recentsSection.php");
?>
	</div>
<?php		
		require("music.php");
		getMusic("/media/search.mp3");
?>
	</body>
</html>