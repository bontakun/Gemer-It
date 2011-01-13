<?php
	function getMusic($path) {
		if ($_COOKIE["themeMusic"] && $_COOKIE["themeMusic"] == "true") {
			?><audio autoplay loop src="<?php echo($path); ?>"><?php
		}
	}
?>