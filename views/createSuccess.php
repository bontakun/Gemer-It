<?php /* view */ ?>
<html>
	<head>
		<title>Gemer It: Results</title>
		<link rel="stylesheet" type="text/css" href="style/global.css" />
		<meta name="viewport" content="width=630" />
		<script type="text/javascript">
			var link = "<?php echo($url); ?>";
		</script>
	</head>
	<body>
		<?php require("settings.php"); ?>
		<div class="headerSection">
			<h1>Gemer It: Results</h1>			
		</div>
	
		<div class="url">
			<p id="link"><?php echo($url); ?></p>
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
<?php		
		require("music.php");
		getMusic("/media/created.mp3");
?>
	</body>
</html>