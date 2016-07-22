<?php
	/* According to documentation, $arg should be an array consisting of 3 thing:
	 * #0 - A string with the app's name
	 * #1 - A string with the link to the app download (a file name)
	 * #2 - A string with the summary of the app 
	*/
	function PluginRun($arg) {
		/* If the "content" of the download does not start with the internal identifier for itunes apps 
		 * (itunes:) which tells this plugin to run, don't do anything and let the system use the default behaivor
		 */
		if(startsWith($arg[1], "itunes:") == false) {
			return false;
		} else {
			/* Remove itunes: from the link */
			$itunes_link = str_replace("itunes:", "", $arg[1]);
			echo '<center><a href="' . $itunes_link . '">
<img border="0" alt="Download on the App Store" src="plugins/AppStoreLinks.plugin/AppStoreLinks/badge.png" width="310" height="115"></a></center>';
			echo "<hr>Read a description on the AppStore</hr>";
return true;
		}
	}
	
	/* This function found on StackOverflow - 
	 * http://stackoverflow.com/questions/834303/startswith-and-endswith-functions-in-php 
	 */
	function startsWith($haystack, $needle) {
    		// search backwards starting from haystack length characters from the end
    		return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
	}
?>