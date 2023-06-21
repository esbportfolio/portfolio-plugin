
// Brings up time controls for current project
function lookupTime(projId, pluginDir) {
	
	// If the project ID is present, proceed
	if ( projId > 0 ) {
		
		// Show the time control div
		elem = document.getElementById('project-time-control');
		elem.classList.remove('d-none');
		
		// AJAX
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				elem.innerHTML = this.responseText;
			}
		};
		xmlhttp.open('GET', pluginDir + '\\inc\\test.php', true);
		xmlhttp.send();
	
	// Hide the time controls if it isn't
	} else {
		document.getElementById('project-time-control').classList.add('d-none');
	}
	
}
