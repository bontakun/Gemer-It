<?php /* view */ ?>
<html>
	<head>
		<title>Gemer It: Recent Links</title>
		<link rel="stylesheet" type="text/css" href="style/global.css" />
		<link rel="stylesheet" type="text/css" href="style/recents.css" />
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
	foreach ($recents as $recent) {
?>
		<tr>
			<td class='id'><?php echo($recent["hash"]); ?></td>
			<td class='url'>
				<a href='<?php echo($recent["url"]); ?>'>
					<?php 
						//use chunk_split to split up the string into segments of 76 chars each
						//this allows linebreaking, which makes it look much much nicer.
						echo(chunk_split($recent["url"])); 
					?>
				</a>
			</td>
		</tr>
<?php
	}
?>
		</table>
	</div>
	</body>
</html>