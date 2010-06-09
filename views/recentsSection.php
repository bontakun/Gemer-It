<?php
	for ($i = 0; $i < sizeof($results); $i++) {
		$result = $results[$i];
?>
			<li>
				<?php require("aboutRow.php"); ?>
				<!-- date: <?php echo(date("M j Y:W", $result["creationDate"]) . "--" . $stateEnum); ?> -->
			</li>
			
<?php
	}
?>
		</ul>