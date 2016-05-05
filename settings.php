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
     		 <h4>Color Options</h4>
     		 <div class="input-field col s6">
          <i class="material-icons prefix">invert_colors</i>
          <input id="color_input" type="text" class="validate" name="background" placeholder="Homepage Header Background" oninput="isOk()">

        </div>
        
        <div class="input-field col s6">
          <i class="material-icons prefix">invert_colors</i>
          <input id="text_color_input" type="text" class="validate" name="textcolor" placeholder="Homepage Header Text Color" oninput="isOk()">
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
        
        
        </form>
     		 
     		 