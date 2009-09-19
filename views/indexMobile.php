<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta content="yes" name="apple-mobile-web-app-capable" />
		<meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type" />
		<meta content="minimum-scale=1.0, width=device-width, maximum-scale=0.6667, user-scalable=no" name="viewport" />

		<link href="/iwebkit/css/style.css" rel="stylesheet" type="text/css" />
		<script src="/iwebkit/javascript/functions.js" type="text/javascript"></script>

		<title>Gemer It</title>
	</head>

	<body>

		<div id="topbar">
			<div id="title">Gemer It</div>
		</div>
	
		<form name="gemerForm" method="get" action="create.php">
			<div id="content">
				<ul class="pageitem">
	
					<li class="form">
						<input placeholder="Page URL" type="text" name="url">
					</li>
	
					<li class="form">
						<input name="Submit" type="submit" value="Gemer It Up" />
					</li>
					
				</ul>
				
				<ul class="pageitem">
	
					<li class="menu">
		  			<a class="noeffect" href="recents.php">
		  				<span class="name">Recently Created</span>
		  				<span class="arrow"></span>
		  			</a>
		  		</li>
		  		<li class="menu">
		  			<a class="noeffect" href="recentsByIp.php">
		  				<span class="name">Recently Created By IP</span>
		  				<span class="arrow"></span>
		  			</a>
		  		</li>
				</ul>
			</div>
		</form>
	
	</body>
</html>