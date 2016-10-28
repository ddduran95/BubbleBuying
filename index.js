document.addEventListener('DOMContentLoaded', function() {
	
	// desplegar menu
	document.querySelector("#categoriasmenuitem").onclick = function() { 
		var menuItems = document.querySelectorAll("#categoriasmenuitem ul");
		for (i = 0; i<menuItems.length; i++) {
			menuItems[i].classList.toggle("visible");
	
		}
	}
	

}, false);
