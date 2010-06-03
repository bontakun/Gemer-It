<?php
	$todayYear = (int)date("Y");
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

	//fake enum 
	/*	0 = starting
	 *	1 = today
	 *	2 = yesterday
	 *	3 = this week
	 *	4 = last week
	 *  5 = this month
	 *  6 = last month
	 *  7 = this year
	 *	8 = older
	 */
	$stateEnum = 0;

	for ($i = 0; $i < sizeof($results); $i++) {
		$result = $results[$i];
		$resultYear = (int)date("Y", $result["creationDate"]);
		$resultMonth = (int)date("n", $result["creationDate"]);
		$resultDay = (int)date("j", $result["creationDate"]);
		$resultWeek = (int)date("W", $result["creationDate"]);

		if ($todayMonth == $resultMonth && $todayDay == $resultDay) {
			if ($stateEnum == 0) {
				$stateEnum = 1;
?>
			<h3>Today</h3>
			<ul>
<?php 	
			}
		} else if ($yesterdayMonth == $resultMonth && $yesterdayDay == $resultDay) {
			if ($stateEnum < 2) {
				$stateEnum = 2;
				if ($i >= 0)
					echo("</ul>");
?>
			<h3>Yesterday</h3>
			<ul>
<?php
			}
		} else if ($stateEnum < 3  && $stateEnum != 3 && $weekNumber == $resultWeek) {
			$stateEnum = 3;
			if ($i >= 0) 
				echo("</ul>");
?>
			<h3>Earlier This Week</h3>
			<ul>
<?php

		} else if ($stateEnum < 4 && $stateEnum != 5 && ($weekNumber-1) == $resultWeek) {
			$stateEnum = 4;
			if ($i >= 0)
				echo("</ul>");
?>
			<h3>Last Week</h3>
			<ul>
<?php
		} else if ($stateEnum < 5 && stateEnum != 6 && ($weekNumber-1) > $resultWeek) {
			$stateEnum = 5;
			if ($i >= 0)
				echo("</ul>");
?>
			<h3>This Month</h3>
			<ul>
<?php
		} else if ($stateEnum < 6 && $stateEnum != 7 && ($todayMonth -1) == $resultMonth) {
			$stateEnum = 6;
			if ($i >= 0)
				echo("</ul>");
?>
			<h3>Last Month</h3>
			<ul>
<?php
		} else if ($stateEnum < 7 && $stateEnum != 8 && ($todayMonth -1) > $resultMonth) {
			$stateEnum = 7;
			if ($i >= 0)
				echo("</ul>");
?>
			<h3>This Year</h3>
			<ul>
<?php
		} else if ($stateEnum < 8 && $stateEnum != 9 && $todayYear < $resultYear) {
			$stateEnum = 8;
			if ($i >= 0)
				echo("</ul>");
?>
			<h3>Older</h3>
			<ul>
<?php
		}
?>
			<li>
				<a href='http://gemerit.com/<?php echo($result["hash"]); ?>' title='<?php 
					if ($result["title"] && strlen($result["title"]) > 0)
						echo(htmlentities($result["title"]));
					?>'>
<?php 
						//use chunk_split to split up the string into segments of 76 chars each
						//this allows linebreaking, which makes it look much much nicer.
						echo($result["url"]);	
?>
				</a>
				<span><?php echo(htmlentities($result["title"])); ?></span>
				<!-- date: <?php echo(date("M j Y:W", $result["creationDate"]) . "--" . $stateEnum); ?> -->
			</li>
			
<?php
	}
?>
		</ul>