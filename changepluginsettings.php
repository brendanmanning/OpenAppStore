<?php
	include 'admincheck.php';
	if(isset($_POST['downloadExt'])) {
		$d = $_POST['downloadExt'];
	} else {
		header("Location: index.php?error");
		die("");
	}
	
	if(isset($_POST['footerExt'])) {
		$f = $_POST['footerExt'];
	} else {
		header("Location: index.php?error");
		die("");
	}
	
	$pluginFile = '<?php
	// To enable a custom download form, change false to the name of your plugin file inside the plugin folder
	// For example if we wanted to use an extension called aptLink, we would place aptLink.php inside the plugins/ folder
	// ..and type "aptLink.php" in the place of false
	define("DOWNLOAD", {{DLPL}}); 
	// Footer plugin - Runs php file and places output below the content on the main page and above the footer
	// This could be useful is using a visitor counter or featured download plugin
	define("FOOTER", {{FTPL}});
?>';

	$file = fopen("pluginconfig.php", "w");
	if($d == "NONE") {
		$pluginFile = str_replace("{{DLPL}}", "false", $pluginFile);
	} else {
		$pluginFile = str_replace("{{DLPL}}", '"' . $d . '"', $pluginFile);
	}
	if($f == "NONE") {
		$pluginFile = str_replace("{{FTPL}}", "false", $pluginFile);
	} else {
		$pluginFile = str_replace("{{FTPL}}", '"' . $f . '"', $pluginFile);
	}
	
	
	fwrite($file, $pluginFile);
	fclose($file);
	header("Location: admin.php");
?>