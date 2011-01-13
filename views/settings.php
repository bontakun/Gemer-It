<div id="settingsPanel">
	<div id="settingsLabel">GemerSettings</div>
	
	<div id="settings">
		Previews inline:
		<a href="javascript:createCookie('imagesInline', 'true');location.reload(true);"<?php if ($_COOKIE["imagesInline"] == "true") { echo(" class=unselected"); } ?>>on</a> / <a href="javascript:createCookie('imagesInline', 'false');location.reload(true);"<?php if ($_COOKIE["imagesInline"] != "true") { echo(" class=unselected"); } ?>>off</a>
		<br />
		Theme music:
		<a href="javascript:createCookie('themeMusic', 'true');location.reload(true);"<?php if ($_COOKIE["themeMusic"] == "true") { echo(" class=unselected"); } ?>>on</a> / <a href="javascript:createCookie('themeMusic', 'false');location.reload(true);"<?php if ($_COOKIE["themeMusic"] != "true") { echo(" class=unselected"); } ?>>off</a>
		<br />
		Preview URL's before redirect:
		<a href="javascript:createCookie('previewUrl', 'true');location.reload(true);"<?php if ($_COOKIE["previewUrl"] == "true") { echo(" class=unselected"); } ?>>on</a> / <a href="javascript:createCookie('previewUrl', 'false');location.reload(true);"<?php if ($_COOKIE["previewUrl"] != "true") { echo(" class=unselected"); } ?>>off</a>
	</div>
</div>