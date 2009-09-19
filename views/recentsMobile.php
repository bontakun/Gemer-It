<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta content="yes" name="apple-mobile-web-app-capable" />
		<meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type" />
		<meta content="minimum-scale=1.0, width=device-width, maximum-scale=0.6667, user-scalable=no" name="viewport" />

		<link href="/iwebkit/css/style.css" rel="stylesheet" type="text/css" />
		<script src="/iwebkit/javascript/functions.js" type="text/javascript"></script>

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

<?php
	foreach ($recents as $recent) {
?>
			<ul class="pageitem">
					<li class="textbox">
						<p>http://gemerit.com/<?php echo($recent["hash"]); ?></p>
					</li>
					<li class="menu">
		  			<a class="noeffect" href="<?php echo($recent["url"]); ?>">
		  				<span class="name"><?php echo($recent["url"]); ?></span>
		  				<span class="arrow"></span>
		  			</a>
		  		</li>
					
			</ul>
<?php
	}
?>
		  
		</div>
	
	</body>
</html>