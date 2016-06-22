<?php
	// To enable a custom download form, change false to the name of your plugin file inside the plugin folder
	// For example if we wanted to use an extension called aptLink, we would place aptLink.php inside the plugins/ folder
	// ..and type "aptLink.php" in the place of false
	define("DOWNLOAD", false); 
	// Footer plugin - Runs php file and places output below the content on the main page and above the footer
	// This could be useful is using a visitor counter or featured download plugin
	define("FOOTER", "customGitHubLink.php");
?>