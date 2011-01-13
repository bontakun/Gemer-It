function createCookie(name, value) {
	var date = new Date();
	date.setTime(date.getTime() + 31536000000);
	document.cookie = name + "=" + value + "; expires=" + date.toGMTString() + "; path=/";
}

function toggleVisibility(id) {
	var element = document.getElementById(id);
	if (element.style.display && element.style.display == "block") {
		element.style.display = "none";
	} else {
		element.style.display = "block";
	}
}