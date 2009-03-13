<?php /* view */ ?>
<html>
	<head>
		<title>Gemer It: Results</title>
		<link rel="stylesheet" type="text/css" href="style/global.css" />
		<link rel="stylesheet" type="text/css" href="style/createSuccess.css" />
		<meta name="viewport" content="width=630" />
		<script type="text/javascript" src="js/megaman.js" ></script>
		<script type="text/javascript">
			var link = "<?php echo($url); ?>";
		</script>
	</head>
	<body>
		<div class="container">
			<h2>Your Link Is:</h2>
			<p id="link">
				<span><?php echo($url); ?></span>
			</p>
	
			<h2>Links</h2>
			<ul>
				<li><a href="/">Gemer Up Another</a></li>
				<li><a href="<?php echo($url); ?>" target="_blank">Test Link (in New Window)</a></li>
				<li><a href="http://twitter.com/home?status=<?php echo($url); ?>">Post to Twitter</a></li>
<?php 
	if(stristr($_SERVER["HTTP_USER_AGENT"], "iPhone")) {
?>
				<li>
					<a href="javascript:void(window.location='twitterrific:///post?message='+escape(link))">
						Post to Twitterific
					</a>
				</li>
<?php
	}
?>
			</ul>
		</div>
		<div id="megas">
<?php 
	
	//some view specific code :D
	$showRegularMegaMan = rand(0, 10);
	if ($showRegularMegaMan > 3) {
	
?>
				<div class="mega">
					<img src="/img/megaman.gif" />
				</div>
<?php 
	
	}
	else {
	
?>
				<div class="megax">
					<img src="/img/megamanx.gif" />
				</div>
<?php

	}
	
?>
		</div>
	</body>
</html>