<html>
	<head>
		<title>Manage Plugin Settings</title>
			<?php include 'ssl.php'; include 'material.php'; include 'admincheck.php'; include 'adminmenu.php'; ?>
	</head>
	
	<body>
		<!-- Settings form controls -->
	<form action="changepluginsettings.php" method="POST">
		<h4>Edit Plugin Settings</h4>
		<hr>
		<h5>Download Page Extension</h5>
		<form action="updatepluginsettings.php" method="POST">
		<?php
			// List all files in plugin directory. When the user clicks one, it will be put into the input box */
			$files = scandir("plugins/", 1);
			
			for($i = 0; $i < count($files); $i++) {
				if($files[$i] != "." && $files[$i] != "..") { // Ignore directory paths
					echo '<p><input name="downloadExt" value="' . $files[$i] . '" type="radio" id="d' . $i . '"/><label for="d' . $i .'">' . $files[$i] . '</label></p>';
				}
			}
			
			// ECHO none
			echo '<p><input value="NONE" name="downloadExt" type="radio" id="dnone"/><label for="dnone">NONE</label></p>';	
		?>
		<hr>
		<h5>Footer Extension</h5>
		<?php
			// List all files in plugin directory. When the user clicks one, it will be put into the input box */
			$files = scandir("plugins/", 1);
			for($i = 0; $i < count($files); $i++) {
				if($files[$i] != "." && $files[$i] != "..") { // Ignore directory paths
					echo '<p><input value="' . $files[$i] . '" name="footerExt" type="radio" id="f' . $i . '"/><label for="f' . $i .'">' . $files[$i] . '</label></p>';
				}
			}
			
			echo '<p><input value="NONE" name="footerExt" type="radio" id="fnone"/><label for="fnone">NONE</label></p>';		
		?>
		
		<input type="submit" value="Update Plugin Settings" class="btn waves">
		</form>
	</body>
</html>
     		