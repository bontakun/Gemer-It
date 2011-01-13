<html>
	<head>
		<title>Gemer It: URL Shortening Service</title>
		<link rel="stylesheet" type="text/css" href="style/global.css" />
		<style>
			html, body {
					margin: 0px;
					padding: 0px;
			}
		</style>
		<meta name="version" content="2.0">
	</head>
	<body>
		<?php require("settings.php"); ?>
		<form name="gemerForm" method="get" action="create.php">
			<div class="headerSection">
				<h1>Gemer It: URL Shortening Service</h1>
				
				<div id="urlSection">
					<input type="url" name="url" id="url" value="" placeholder="Url to Gemer/Shrink" autofocus>
					<input type="submit" value="Gemer It Up!">
				</div>
			</div>
		
			<div class="explanations">	
				<div class="sections">
					<h2>What</h2>
					<p>
						A URL shortening service, built to be lean, mean &amp; free, not even the hint of
						an ad or for pay scheme.
					</p>
				</div>

				<div class="sections">				
					<h2>Why</h2>
					<p>
						This page was primarily built as challenge. It was originally built as an experiment
						in building simple services in a very short period of time. 
						Gemer it is a constant work in progress, so be prepared for changes.
						Please use <a href="http://bonta-kun.net/contact/?subject=gemerit">contact page</a> for reporting bugs.
					</p>
				</div>
				
				<div class="sections">
					<h2>Extras</h2>
					<p>
						To gemer it up a little easier and faster, I provide the following bookmarklet,
						All you have to do it drag to your bookmark toolbar: 
						<a href="javascript:(function(){if(!(document.getElementById('gemerTainerScriptHolder'))){gemerScript=document.createElement('script');gemerScript.setAttribute('id','gemerTainerScriptHolder');gemerScript.setAttribute('src','http://gemerit.com/js/bookmarklet.js');document.body.appendChild(gemerScript);}else{gemerLink();}})();">Gemer It</a>
					</p><p>
						Other fun stuff includes: the <a href="/blog">gemerblog</a>
						and the <a href="/search.php">recents and search page</a>. And the <a href="/docs/api.htm">gemerAPI documenation</a>.
					</p>
				</div>
				
				<div class="clearer"></div>
			</div>
					
			<div id="footer">
		  	<p>
		  		Gemer It is built and maintained by 
		  		<a href="http://twitter.com/bontakun">Benjamin "bonta-kun"</a> 
		  		of <a href="http://bonta-kun.net">bonta-kun.net</a>. Source code is available at
		  		<a href="http://gemerit.com/62">the bonta-kun.net svn repository</a>.
		  	</p>
			</div>
				
		</form>
<?php		
		require("music.php");
		getMusic("/media/home.mp3");
?>
	</body>
</html>