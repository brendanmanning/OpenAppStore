<?php
	/* Types of plugins are "DOWNLOAD" and "FOOTER" */
	function runPlugin($type, $options) {
		/* Check if a valid type was passed in */
		// use the pluginconfig.php
		require 'pluginconfig.php';
		if($type == "DOWNLOAD") {
			// Download plugin
			if(DOWNLOAD != false) {
				// call PluginRun() method
				require "plugins/" . DOWNLOAD;
				// Provide the plugin with the app's name, link, and summary
				return PluginRun($options);
			} else {
				return false;
			}
		} else if ($type == "FOOTER") {
			// Footer plugin
			if(FOOTER != false) {
				// Run the plugin
				include "plugins/" . FOOTER;
				return true;
			} else {
				return false;
			}
		} else {
			// Return false so the calling page will know to run the default content
			return false;
		}
	}
	
	
	/* DOCUMENTATION 
		- How to make a download plugin:
			- Create a blank PHP file inside the plugins/ folder
			- Go to pluginconfig.php and define DOWNLOAD to the name of the PHP file you just made
			- Add a function to your PHP file called PluginRun($arg)
				- This is the entry point for your plugin. When it loads, this method will be called
				- $arg is the link to the download, so you can incorportate that into your script
				
		- How to make a footer plugin
			- Create a blank PHP file inside the plugins/ folder
			- Go to pluginconfig.php and define FOOTER to the name of the PHP file you just made
			- Add your plugin code to the file you just made
			
	*/
			
?>