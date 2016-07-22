<html>
	<head>
		<title>Settings</title>
		<?php
			include 'material.php';
		?>
		
		<script>
			//Checks that the input is a valid hexadecimal
			function isOk() {
				var background = document.getElementById("color_input").value;
				var text = document.getElementById("text_color_input").value;
				var submitButton = document.getElementById("submitButton");
				var backgroundOk  = /(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(background);
				var textOk = /(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(text);
				if(backgroundOk == true && textOk == true) {
					submitButton.disabled = false;
					submitButton.value = "Update Settings";
				} else {
					submitButton.disabled = true;
					submitButton.value = "!! Hexidecimals not valid !!"
				}
			}
			
			function updateEmail(inputBox,labelId,labelText) {
				var input = document.getElementById(inputBox).value;
				var l = labelId;
				var label = document.getElementById(l);
				if(input.length > 0) {
					label.innerHTML = "";
				} else {
					label.innerHTML = labelText;
				}
			}
			
			function verifyaccountsetting() {
				if(document.getElementById("box3").checked) {
					if(document.getElementById("box1").checked == false) {
						alert("WARNING: You are requiring users to register before downloading, but registration is disabled");
					}
				}
			}
			
			function red(input) {
				document.getElementById(input).value = "#DE1500";
			}
			function green(input) {
				document.getElementById(input).value = "#00BF1A";
			}
			function blue(input) {
				document.getElementById(input).value = "#00186E";
			}
			function black(input) {
				document.getElementById(input).value = "#000000";
			}
			function white(input) {
				document.getElementById(input).value = "#FFFFFF";
			}
			</script>
	</head>
	
	
	
	<body>
	<?php
		include 'admincheck.php';
		include 'adminmenu.php';
	?>
	
	<!-- Settings form controls -->
	<form action="changesettings.php" method="POST">
		<h4>Basic Options</h4>
		<input type="checkbox" name="signups" id="box1" />
     		 <label for="box1">Allow Signups?</label>
     		 <br>
     		 <input type="checkbox" name="ssl" id="box2" />
     		 <label for="box2">Force SSL? (Only is you have a certificate)</label>
     		 <br>
     		 <input type="checkbox" name="requireaccount" id="box3"onchange="verifyaccountsetting()" />
     		 <label for="box3">Require users register before downloading apps*</label>
     		 
     		 <h4>Color Options</h4>
     		 <div class="input-field col s6">
          <i class="material-icons prefix">invert_colors</i>
          <input id="color_input" type="text" class="validate" name="background" placeholder="Homepage Header Background * Enter a hexidecimal or choose a color below *" oninput="isOk()">
	<br>
	<a onclick="red('color_input')">Red</a> | <a onclick="green('color_input')">Green</a> | <a onclick="blue('color_input')">Blue</a> | <a onclick="black('color_input')">Black</a> | <a onclick="white('color_input')">White</a>
        </div>
        
        <div class="input-field col s6">
          <i class="material-icons prefix">invert_colors</i>
          <input id="text_color_input" type="text" class="validate" name="textcolor" placeholder="Homepage Header Text Color * Enter a hexidecimal or choose a color below *" oninput="isOk()">
          <br>
          <a onclick="red('text_color_input')">Red</a> | <a onclick="green('text_color_input')">Green</a> | <a onclick="blue('text_color_input')">Blue</a> | <a onclick="black('text_color_input')">Black</a> | <a onclick="white('text_color_input')">White</a>
        </div>
        
        <h4>Site Information</h4>
         <div class="input-field col s6">
        	<i class="material-icons prefix">info_outline</i>
          <input id="site_name" type="text" name="name" class="validate" placeholder="Site Name" value=
          													<?php
          														include 'config.php';
          														echo '"' . TITLE . '"';
          													?>
          >
        
            </div>
          
          <div class="input-field col s6">
        	<i class="material-icons prefix">email</i>
          <input id="site_mail" type="email" name="email" class="validate" placeholder="Contact Email" value=
          													<?php
          														include 'config.php';
          														echo '"' . CONTACT . '"';
          													?>
          >
          
            </div>
        <input type="submit" class="btn waves" value="Update Settings" id="submitButton" onclick="isOk()">
       <center><p>* Users may not be required to register when using certain download page extensions</p></center>
        </form>
     		 <hr>
     		 
     		 <?php
     		 	// Check if plugins are enabled //
     		 	require 'pluginconfig.php';
     		 	if(DOWNLOAD != false) 
     		 	{
     		 		// Download plugins are enabled
     		 		// Check if the plugin has a settings file
     		 		$settingsFile = str_replace(".php", "", DOWNLOAD) . "-settings.php";
     		 		if(file_exists("plugins/" . $settingsFile)) {
     		 			// There is a settings file
     		 			echo '<h4>Plugin Settings</h4>';
     		 			include  $settingsFile;
     		 		} 
     		 	}
     		 	
     		 	if(FOOTER != false) {
     		 		$settingsFile = str_replace(".php", "", FOOTER) . "-settings.php";
     		 		if(file_exists("plugins/" . $settingsFile)) {
     		 			// There is a plugin
     		 			echo '<h4>Plugin Settings</h4>';
     		 			include $settingsFile;
     		 }
     		 		}	
     		 ?>
     		 