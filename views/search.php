<?php /* view */ ?>
<html>
	<head>
		<title>Gemer It: Search</title>
		<link rel="stylesheet" type="text/css" href="style/global.css" />
		<link rel="stylesheet" type="text/css" href="style/about.css" />
		<link rel="stylesheet" type="text/css" href="style/search.css" />
		<meta name="viewport" content="width=630" />
	</head>
	<body>
	<div class="container">
		<h2>Gemer It Search</h2>
		<form name="gemerForm" method="get" action="search.php">
			<span>Search Term: </span>
			<input type="search" size="72" autofocus placeholder="put search terms in here" name="searchTerm">
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
	</body>
</html>