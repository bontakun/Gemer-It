<?php /* view */ ?>
<html>
	<head>
		<title>Gemer It: Recent Links</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<meta name="viewport" content="width=630" />
	</head>
	<body>
	<div class="container">
	<h2>Gemer It Recent Links</h2>
	
		<table class='resultsTable'>
		<tr>
			<th>Link ID</th>
			<th>URL</th>
		</tr>
<?php
	//if I were less lazy this would build an array and that would keep this controller/model seepage 
	while ($resultArray = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$hash = dechex($resultArray["id"]);
		$url = $resultArray["url"];
?>
		<tr>
			<td class='id'><?php echo($hash); ?></td>
			<td class='url'>
				<a href='<?php echo($url); ?>'><?php echo($url); ?></a>
			</td>
		</tr>
<?php
	}
?>
		</table>
	</div>
	</body>
</html>