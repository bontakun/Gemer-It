<?php /* view */ ?>
<?php header("Content-Type: application/xml "); ?>
<results>
<?php
	for ($i = 0; $i < sizeof($results); $i++) {
		$result = $results[$i];
		require("aboutRowXML.php");
	}
?>

<results>