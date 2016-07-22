<?php
	/* Get all the values from POST */
	// Get signups checkbox
	$signups = $_POST['signups'];
	// Make sure settings are valid
	if(isset($_POST['requireaccount'])) {
		if(!isset($signups)) { 
			die("<strong>You can't disable signups and force people to sign up to download at the same time!</strong>");
		}
	}
	// Get force SSL checkbox
	$ssl = $_POST['ssl'];
	// Get the background hex 
	$background = $_POST['background'];
	// Get the header text color
	$textcolor = $_POST['textcolor'];
	// Get the site name 
	$name = $_POST['name'];
	// Get the contact email
	$email = $_POST['email'];
	// Get the site url from the current config
	include 'config.php';
	$url = URL;
	// Now replace the config.php file
	
	// First make the template file
	$template = '<?php
	/* OPEN APP STORE - config.php */
    /* SET OPTIONS FOR OPENAPPSTORE */
    /* This is where you put the URL of your website */\
    /* It must end with a slash, like this / */
	define("URL", {{URL}}); 
    /* The title of your website */
    /* It is shown on the menu bar, homepage, and various places across your website */
	define("TITLE", {{TITLE}});
    /* Subtitle is shown below the title on the homepage */
	define("SUBTITLE", "Download apps for PC");
    /* This feature is not currently active - You may ignore this */
	define("PREFIX", "ignore ");
    /* Your administrator email, will be shown in the contact menu */
	define("CONTACT", {{EMAIL}});
    /* This defines the background color of the title part at the top of the homepage */
    /* it should be in hexadecimal format */
    /* If you are unsure of what color to use, go to color.adobe.com to help you choose */
	define("COLOR", {{MAINCOLOR}}); 
    /*This is the same as above but for the text not the background */
    /* NOTE: For COLOR and TEXTCOLOR, the default value works fine if you dont know what to do */
	define("TEXTCOLOR", {{TEXTCOLOR}}); 
    /* If your website has an SSL certificate, set this to true */
    /* otherwise leave it false b/c it will direct users to an SSL connection their browsers may reject */
	define("SSL", {{SSLVAL}}); //true or false
	define("REGISTERED", {{RVAL}}); // Set to true to disable other people from signing up (reccommended)
	define("REQUIREACCOUNT", {{RAVAL}});
?>';
	$cfgFile = fopen("config.php", "w") or die("Unable to open file!");
	
	$template = str_replace("{{TITLE}}", '"' . str_replace("}}", "", str_replace("{{", "", (str_replace("'", "", $name)))) . '"' , $template);
	$template = str_replace("{{EMAIL}}", '"' . str_replace("}}", "", str_replace("{{", "", (str_replace("'", "", $email)))). '"' , $template);
	$template = str_replace("{{MAINCOLOR}}", '"' . $background. '"' , $template);
	$template = str_replace("{{TEXTCOLOR}}", '"' .  $textcolor .'"' , $template);
	
	// Now check the checkbox values
	if(isset($signups)) {
		$template = str_replace("{{RVAL}}", "false", $template);
	} else {
		$template = str_replace("{{RVAL}}", "true", $template);
	}
	
	if(isset($ssl)) {
		$template = str_replace("{{SSLVAL}}", "true", $template);
	} else {
		$template = str_replace("{{SSLVAL}}", "false", $template);
	}
	
	
	if(isset($_POST['requireaccount'])) {
		$template = str_replace("{{RAVAL}}", "true", $template);
	} else {
		$template = str_replace("{{RAVAL}}", "false", $template);
	}
	// Don't forget to set the URL
	$template = str_replace("{{URL}}", '"' . $url . '"', $template);
	// write to file
	fwrite($cfgFile, $template);
	
	// close
	fclose($cfgFile);
	// Assuming this all worked, redirect to admin page
	
	header("Location: admin.php");
	
?>
	
	
	