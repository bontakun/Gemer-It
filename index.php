<html>
	<head>
		<title>Gemer It: URL Shortening Service</title>
		<meta name="viewport" content="width=630" />
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<form name="gemerForm" method="get" action="create.php">
			<div class="container">
				<div class="headerSection">
					<h1>Gemer It: URL Shortening Service</h1>
					
					<div class="urlSection">
						<input type="text" name="url" value="">
						<input type="submit" value="Gemer It Up!" ="submit">
					</div>
				</div>
				<div class="explanations">
					<h2>What</h2>
					<p>
						Yet another URL shortening service, this one built to be lean and mean, 
						and maybe (if we're lucky) gemer it up a notch.
					</p>
					
					<h2>Why</h2>
					<p>
						This page was primarily built as joke, but is fully functional and should 
						work for any URL you can throw at it. So please try to break it. Please
						use <a href="http://bonta-kun.net/contact/?subject=gemerit">contact page</a> 
						for reporting bugs.
					</p>
					<!--
					<h2>How</h2>
					<p>
						Gemer It powered by entirely open source technologies such as 
						<a href="http://wikipedia.org/wiki/Linux">Linux</a>, 
						<a href="http://mysql.com/">MySQL</a>, 
						<a href="http://php.net/">PHP</a>, and
						<a href="http://apache.org/">Apache</a>.
					</p>
					-->
					<h2>Bookmarklet</h2>
					<p>
						To gemer it up a little easier and faster, I provide the following bookmarklet,
						all you should have to do it drag to your bookmark toolbar and it'll be good to go.
						<a href="javascript:void(location.href='http://gemerit.com/create.php?url='+location.href)">Gemer It Up!</a>
					</p>
					
					<h2>Other Items of Interest</h2>
					<p>
						New to the gemer it franchise are the <a href="http://gemerit.com/blog">gemerblog</a>
						and the <a href="http://gemerit.com/recents.php">recently created links page</a>.
					</p>
					<p>
						Gemer It is built and maintained by <a href="http://twitter.com/bontakun">Benjamin "bonta-kun"</a> 
						of <a href="http://bonta-kun.net">bonta-kun.net</a>. Source code is available at
						 <a href="http://gemerit.com/62">the bonta-kun.net svn repository</a>.
					</p>
					
				</div>
			</form>
	</body>
<html>