<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta content="minimum-scale=1.0, width=device-width, maximum-scale=0.6667, user-scalable=no" name="viewport" />

		<title>Gemer It: Recents</title>
	</head>

	<body>

		<div id="topbar">
			<div id="leftnav">
				<a href="/">
					Gemer It
				</a>
			</div>
			
			<div id="title">Recents</div>
		</div>
	
		<div id="content">
				<ul class="pageitem">
<?php
	foreach ($recents as $recent) {
?>
					<li class="menu">
		  			<a class="noeffect" href="http://gemerit.com/<?php echo($recent["hash"]);?>">
		  				<span class="name"><?php echo($recent["url"]); ?></span>
		  				<span class="arrow"></span>
		  			</a>
		  		</li>
<?php
	}
?>
		  </ul>
		</div>
	
	</body>
</html>