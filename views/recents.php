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
	
<?php
	$todayMonth = (int)date("n");
	$todayDay = (int)date("j");
	
	$yesterdayMonth = (int)date("n");
	$yesterdayDay = ((int)date("j")) -1;
	//acount for first day of the month
	if ($yesterdayDay == 0) {
		$yesterdayMonth = $yesterdayMonth -1;
		$yesterdayDay = date("t", mktime(0, 0, 0, $yesterdayMonth));
		
	}
	
	$weekNumber = (int)date("W");
	
	echo("<!-- date data: $todayMonth-$todayDay, $yesterdayMonth-$yesterdayDay, $weekNumber -->");

	//fake enum 
	/*	0 = starting
	 *	1 = today
	 *	2 = yesterday
	 *	3 = this week
	 *	4 = older
	 */
	$stateEnum = 0;

	for ($i = 0; $i < sizeof($recents); $i++) {
		$recent = $recents[$i];
		$recentMonth = (int)date("n", $recent["creationDate"]);
		$recentDay = (int)date("j", $recent["creationDate"]);
		$recentWeek = (int)date("W", $recent["creationDate"]);

		if ($todayMonth == $recentMonth && $todayDay == $recentDay) {
			if ($stateEnum == 0) {
				$stateEnum = 1;
?>
			<h3>Today</h3>
			<ul>
<?php 	
			}
		} else if ($yesterdayMonth == $recentMonth && $yesterdayDay == $recentDay) {
			if ($stateEnum < 2) {
				$stateEnum = 2;
				if ($i > 0)
					echo("</ul>");
?>
			<h3>Yesterday</h3>
			<ul>
<?php
			}
		} else if ($stateEnum < 3  && $stateEnum != 3 && $weekNumber == $recentWeek) {
			$stateEnum = 3;
			if ($i > 0) 
				echo("</ul>");
?>
			<h3>Earlier This Week</h3>
			<ul>
<?php

		} else if ($stateEnum < 4 && $stateEnum != 5 && $weekNumber > $recentWeek) {
			$stateEnum = 4;
			if ($i > 0)
				echo("</ul>");
?>
			<h3>Older</h3>
			<ul>
<?php
		}
?>
			<li>
				<a href='http://gemerit.com/<?php echo($recent["hash"]); ?>'>
					<?php 
						//use chunk_split to split up the string into segments of 76 chars each
						//this allows linebreaking, which makes it look much much nicer.
						echo(chunk_split($recent["url"])); 
					?>
				</a>
				<!-- date: <?php echo(date("W:M j Y", $recent["creationDate"])); ?> -->
			</li>
			
<?php
	}
?>
		</ul>
	</div>
	</body>
</html>