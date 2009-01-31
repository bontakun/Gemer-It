<?php /* controller/model */ ?>
<?php
	require("library.php");
	
	$url = $_REQUEST["url"];
	
	//we're going to preppend http if they gave us a url that doesn't already have it
	if (!preg_match("/^https?:\/\//", $url))
		$url = "http://" . $url;
	
	//attempt to retrieve the item
	$query = "SELECT id FROM urls where url = '" . 
			addslashes($url) . "';";
	$result = mysql_query($query) or die('Query failed: ' . mysql_error());
	
	//if it's not there we need to insert and retrieve
	if (mysql_num_rows($result) == 0)
	{
		//insert
		$query = "INSERT INTO urls (url) VALUES ('" . 
			addslashes($url) . "');";
		mysql_query($query) or die('Query failed: ' . mysql_error());
		
		//get back the thing we just inserted
		$query = "SELECT id FROM urls where url = '" . 
			addslashes($url) . "';";
		$result = mysql_query($query) or die('Query failed: ' . mysql_error());	
	}
	
	//get results in easy to use array format
	$resultArray = mysql_fetch_assoc($result);
	
	$url = "http://" . $_SERVER["SERVER_NAME"]  . "/" . dechex($resultArray["id"]);
	
	//Special iPhone Twitterific integration pending more work
	if (stristr($_SERVER["HTTP_USER_AGENT"], "iPhone")) {
		$iphoneStuff = true;
	}
?>

<?php /* view */ ?>
<html>
	<head>
		<title>Gemer It: Results</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
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

<?php	
	mysql_close($link);
?>