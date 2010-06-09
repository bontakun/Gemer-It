<div class="urlBlock">
	<span class="shortUrl">
  	<a href="http://gemerit.com/<?php echo($result["hash"]); ?>">http://gemerit.com/<?php echo($result["hash"]); ?></a></span>
  <dl>
  <?php if ($result["title"]) { ?>
  	<dt>Title</dt>
  	<dd><?php 
  		//special search code
  		if (strlen($_REQUEST["searchTerm"]) > 0) {
  			$searchTerm = $_REQUEST["searchTerm"];
  			echo(preg_replace("/($searchTerm)/im", '<span class="match">\1</span>', $result["title"]));
  		} else {
  			echo($result["title"]); 
  		}
  	?></dd>
	<?php } if ($result["visits"] > 0) { ?> 	
  	<dt>Visits</dt>
  	<dd><?php echo($result["visits"]); ?></dd>
  <?php } if ($result["creationDate"] > 0) { ?>
  	<dt>Created</dt>
  	<dd><?php echo(date("M j Y", $result["creationDate"])); ?></dd>
  <?php } ?>
  	<dt>Long Url</dt>
  	<dd><a href="<?php echo($result["url"]); ?>"><?php 
  		//special search code
  		if (strlen($_REQUEST["searchTerm"]) > 0) {
  			$searchTerm = $_REQUEST["searchTerm"];
  			echo(preg_replace("/($searchTerm)/im", '<span class="match">\1</span>', $result["url"]));
  		} else {
  			echo($result["url"]); 
  		} 
  		?></a></dd>
  </dl>
  <!-- source ip  <?php echo($result["ip"]); ?> -->
  <div class="clearer"></div>
</div>
