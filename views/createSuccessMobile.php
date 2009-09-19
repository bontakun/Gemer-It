<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta content="yes" name="apple-mobile-web-app-capable" />
		<meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type" />
		<meta content="minimum-scale=1.0, width=device-width, maximum-scale=0.6667, user-scalable=no" name="viewport" />

		<link href="/iwebkit/css/style.css" rel="stylesheet" type="text/css" />
		<script src="/iwebkit/javascript/functions.js" type="text/javascript"></script>
		<script type="text/javascript">
			var link = "<?php echo($url); ?>";
		</script>

		<title>Gemer It: Results</title>
	</head>

	<body>

		<div id="topbar">
			<div id="leftnav">
				<a href="/">
					Gemer It
				</a>
			</div>
			
			<div id="title">Results</div>
		</div>
	
		<div id="content">
		  <ul class="pageitem">
		  	
		  	<li class="menu">
		  		<span class="name"><?php echo($url); ?></span>
		  	</li>
		  	
		  	<li class="menu">
		  		<a class="noeffect" href="<?php echo($url); ?>" target="_blank">
		  			<span class="name">Test Link (in New Window)</span>
		  			<span class="arrow"></span>
		  		</a>
		  	</li>
		  </ul>
		  
		  <span class="graytitle">Sharing (Twitter)</span>
		  
		  <ul class="pageitem">
		  	
		  	<li class="menu">
		  		<a class="noeffect" href="http://twitter.com/home?status=<?php echo($url); ?>">
		  			<span class="name">Post to Twitter</span>
		  			<span class="arrow"></span>
		  		</a>
		  	</li>
		  	
		  	<li class="menu">
		  		<a class="noeffect" href="javascript:void(window.location='twitterrific:///post?message='+escape(link))">
		  			<span class="name">Post to Twitterrific</span>
		  			<span class="arrow"></span>
		  		</a>
		  	</li>
		  	
		  	<li class="menu">
		  		<a class="noeffect" href="javascript:void(window.location='tweetie:///'+escape(link))">
		  			<span class="name">Post to Tweetie</span>
		  			<span class="arrow"></span>
		  		</a>
		  	</li>
		  
		  </ul>
		  
		  <span class="graytitle">Sharing (Other)</span>
		  
		  <ul class="pageitem">
		  	<li class="menu">
		  		<a class="noeffect" href="javascript:void(window.location='http://www.facebook.com/sharer.php?u='+escape(link))">
		  			<span class="name">Post to Facebook</span>
		  			<span class="arrow"></span>
		  		</a>
		  	</li>
		  	<li class="menu">
		  		<a class="noeffect" href="javascript:void(window.location='http://www.stumbleupon.com/submit?url='+escape(link)'">
		  			<span class="name">Post to Stumble Upon</span>
		  			<span class="arrow"></span>
		  		</a>
		  	</li>	
		  </ul>
		  
		  
		</div>
	
	</body>
</html>