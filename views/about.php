<?php /* view */ ?>
<html>
	<head>
		<title>Gemer It: Link Info</title>
		<link rel="stylesheet" type="text/css" href="/style/global.css" />
		<link rel="stylesheet" type="text/css" href="/style/about.css" />
		<meta name="viewport" content="width=630" />
	</head>
	<body>
	<div class="container">
	<h2>Gemer It Link Info</h2>
		<div id="container">
<?php 
			$result = $results[0]; 
			require("aboutRow.php");
?>
		</div>
	</body>
</html>