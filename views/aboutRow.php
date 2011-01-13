<div class="urlBlock">
	
	<span class="shortUrl">
		<a href="http://gemerit.com/<?php echo($result["hash"]); ?>">http://gemerit.com/<?php echo($result["hash"]); ?></a>
	</span>
  	
	<div class="dl">
  <?php if ($result["title"]) { ?>
		<div class="lineItem">
			<span class="label">Title</span>
			<span class="content"><?php 
	  		//special search code
	  		if (strlen($_REQUEST["searchTerm"]) > 0) {
	  			$searchTerm = preg_replace("/\//", "\\/", $_REQUEST["searchTerm"]);
	  			echo(preg_replace("/($searchTerm)/im", '<span class="match">\1</span>', htmlentities($result["title"])));
	  		} else {
	  			echo(htmlentities($result["title"])); 
	  		}
	  	?></span>
		</div>
	<?php } if ($result["visits"] > 0) { ?>
		<div class="lineItem"> 	
			<span class="label">Visits</span>
			<span class="content"><?php echo($result["visits"]); ?></span>
		</div>
  <?php } if ($result["creationDate"] > 0) { ?>
		<div class="lineItem">
			<span class="label">Created</span>
			<span class="content"><?php echo(date("M j Y", $result["creationDate"])); ?></span>
		</div>
  <?php } ?>
		<div class="lineItem">
			<span class="label">Long Url</span>
			<span class="content"><a href="http://gemerit.com/<?php echo($result["hash"]); ?>"><?php 
	  		//special search code
	  		if (strlen($_REQUEST["searchTerm"]) > 0) {
	  			$searchTerm = preg_replace("/\//", "\\/", $_REQUEST["searchTerm"]);
	  			echo(preg_replace("/($searchTerm)/im", '<span class="match">\1</span>', $result["url"]));
	  		} else {
	  			echo($result["url"]); 
	  		} 
  		?></a></span>
		</div>
		
<?php 	
			parse_str(parse_url($result["url"], PHP_URL_QUERY), $params); 			
			if($_REQUEST["imagesInline"] == "true" || $_COOKIE["imagesInline"] == "true") {
					if (eregi(".*(\.jpg|\.gif|\.png|\.jpeg)$", $result["url"])) { ?>
   			 
		<div class="lineItem">
			<span class="label">Preview</span>
			<span class="previewContent">
					<img src="<?php echo($result["url"]); ?>"/>
			</span>
		</div>
		
<?php			} else if (stristr($result["url"], ".youtube.com/watch") && $params["v"]) { ?>
		<div class="lineItem">
			<span class="label">Preview</span>
			<span class="previewContent">
					<iframe class="youtube-player" type="text/html" width="640" height="385" src="http://www.youtube.com/embed/<?php echo($params["v"]); ?>" frameborder="0">
					</iframe> 
			</span>
		</div>
<?php 	}
			} ?>
  </div>
</div>
