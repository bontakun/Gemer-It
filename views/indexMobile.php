<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta content="minimum-scale=1.0, width=device-width, maximum-scale=0.6667, user-scalable=no" name="viewport" />
		<title>Gemer It [Mobile]</title>
		<style>
			html, body, form {
				padding: 0px;
				margin: 0px;
				font-size: 12pt;
			}
			
			h1 {
				margin: 0px 0px 10px 0px;
				padding: 4px;
				background-color: #00477F;
				color: white;
				text-align: center;
				
				border-bottom: 2px solid #4C88BE;
				
				border-bottom-left-radius: 3px;
			  border-bottom-right-radius: 3px;
			  -moz-border-radius-bottomleft: 3px; 
			  -webkit-border-bottom-left-radius: 3px;
				-moz-border-radius-bottomright: 3px;
				-webkit-border-bottom-right-radius: 3px;
			}
		
			div#urlSection {
				text-align: center;
			  margin: 10px 20px 10px 20px;
			}
			
			div#urlSection input[type="url"] {
				width: 100%;
				font-size: 12pt;
			
				margin: 0px;
				padding: 2px;
				
			  color: black;
			  background-color: #8DC3E9;
			  
			  border-radius: 3px;
			  -moz-border-radius: 3px;
			  -webkit-border-radius: 3px;
			  border: 2px solid #8DC3E9;
			}
			
			div#gemerButton {
				background-color: #4C88BE;
				color: white;
				
				text-decoration: none;
				font-style: normal;
				font-weight: normal;
				
			  font-size: 12pt;
			  
			  width: 140px;
			  margin: 10px auto 0px auto;
			  padding: 0;
			  
				border-radius: 3px;
			  -moz-border-radius: 3px;
			  -webkit-border-radius: 3px;
			  border: 2px solid #8DC3E9;
			  cursor: pointer;
			}

			
			div.links a {
				color: white;
				text-decoration: none;
				
				border: 2px solid #8DC3E9;
				background-color: #4C88BE;
				border-radius: 3px;
			  -moz-border-radius: 3px;
			  -webkit-border-radius: 3px;
			  
			  margin: 4px 10px 10px 20px;
			  
			  padding: 2px;
				display: block;
			}
			
			div.links a:active, div.links a:hover, div#gemerButton:hover {
				background-color: #00477F;
				color: white;
			}
		
		</style>
	</head>

	<body>		
		<h1>Gemer It [Mobile]</h1>

		<div id="urlSection">
			<form name="gemerForm" method="get" action="create.php" id="gemerForm">
				<input placeholder="URL to Gemer/Shrink" type="url" name="url" autofocus id="urlInput">
				<div id="gemerButton" onclick="document.getElementById('gemerForm').submit();">Gemer It Up</div>
			</form>
		</div>
		<div class="links">
  		<a href="recents.php">
  			<span class="name">Recently Created</span>
  		</a>
  		<a href="recentsByIp.php">
  			<span class="name">Recently Created By IP</span>
			</a>
		</div>
	</body>
</html>