<?php /* view */ ?>
<html>
	<head>
		<title>Gemer It: Link Info</title>
		<link rel="stylesheet" type="text/css" href="/style/global.css" />
		<meta name="viewport" content="width=630" />
	</head>
	<body>
	<div class="container">
	<h2>Gemer It Link Info</h2>
		<?php require("settings.php"); ?>
		<div id="container">
<?php 
			$result = $results[0]; 
			require("aboutRow.php");
?>
		</div>
	</body>
</html>