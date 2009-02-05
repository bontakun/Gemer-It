<?php /* view */ ?>
<html>
	<head>
		<title>Gemer It: Results</title>
		<link rel="stylesheet" type="text/css" href="style/style.css" />
		<meta name="viewport" content="width=630" />
		<script type="text/javascript" >
			var link = "<?php echo($url); ?>";
		</script>
	</head>
	<body>
	<div class="container">
		<h2>Your Link Is:</h2>
		<p id="link">
			<span><?php echo($url); ?></span>
		</p>
		
<?php 
	if($iphoneStuff) {
?>
		<h2>Bonus iPhone Links</h2>
		<p>
				<span>
					<a href="javascript:void(window.location='twitterrific:///post?message='+escape(link))">
						Post to Twitterific
					</a>
				</span>
		</p>
<?php
	}
?>
		<h2>Other</h2>
		<p>
			<a href="/">Gemer Up Another</a>
		</p>
	</div>
	</body>
</html>