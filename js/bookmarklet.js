function gemerLink() {
	var gemerTainer = document.createElement("div");
	gemerTainer.setAttribute('style','color:black;border:3px solid #6c6c6c;position:fixed;top:5px;left:5px;background-color:white;z-index:5000000;-moz-border-radius:5px;-webkit-border-radius:5px;border-radius: 5px;float:none;');

	var gemerFrame = document.createElement("iframe");
	gemerFrame.setAttribute('src','http://gemerit.com/create.php?format=thin&url='+escape(window.location)+"&title="+escape(document.title));
	gemerFrame.setAttribute('style','border:none;height:30px;width:200px;z-index:500000;');
	gemerFrame.setAttribute('scrolling','no');
	gemerTainer.appendChild(gemerFrame);

	var gemerClose = document.createElement("div");
	gemerClose.setAttribute('style', 'background-color:#e6e6e6;color:black;display:block;margin:auto;text-align:center;cursor:pointer;font-size:11pt;float:none;');
	gemerClose.innerHTML = "close";
	gemerClose.onclick = function() {
		document.body.removeChild(gemerTainer);
	};
	
	gemerTainer.appendChild(gemerClose);
	document.body.appendChild(gemerTainer);
}

function addThisToDom() {
	if (!(document.getElementById('gemerTainerScriptHolder'))) {
		gemerScript=document.createElement('script');
		gemerScript.setAttribute('id','gemerTainerScriptHolder');
		gemerScript.setAttribute('src','http://gemerit.com/js/bookmarklet.js');
		document.body.appendChild(gemerScript); 
	}
	else {
		gemerLink();
	}
}

gemerLink();