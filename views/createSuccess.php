<?php /* view */ ?>
<html>
	<head>
		<title>Gemer It: Results</title>
		<link rel="stylesheet" type="text/css" href="style/createSuccess.css" />
		<meta name="viewport" content="width=630" />
		<script type="text/javascript">
			var link = "<?php echo($url); ?>";
		</script>
	</head>
	<body>
	
		<div class="headerSection">
			<h1>Gemer It: Results</h1>			
		</div>
	
		<div class="url">
			<p id="link">
				<?php echo($url); ?>
			</p>
		</div>	
			
		<!-- mega man easter egg section -->
		<div id="megas">
<?php 
	//some view specific code :D
	$showMegaMan = rand(0, 10);
	if ($showMegaMan <= 1) {
?>
				<div class="mega">
					<img src="img/megaman.gif" />
				</div>
<?php 
	}
?>
		</div>	
			
		<div class="links">	
			<ul>
				<li><a href="/">Gemer Up Another</a></li>
				<li><a href="<?php echo($url); ?>" target="_blank">Test Link (in New Window)</a></li>
				<li><a href="http://twitter.com/home?status=<?php echo($url); ?>">Post to Twitter</a></li>
			</ul>
		</div>
		
		<div id="footer">
	  	<p>
	  		Gemer It is built and maintained by 
	  		<a href="http://twitter.com/bontakun">Benjamin "bonta-kun"</a> 
	  		of <a href="http://bonta-kun.net">bonta-kun.net</a>.
	  	</p>
		</div>
	</body>
</html>