<html>
	<head>
		<?php
			include 'material.php';
		?>
	</head>
	<style>
		//.textarea {
		//	width = 90%;
			//height = 80%;
		}
		</style>
		
		
	<body>
	
	<?php
		require 'login/classes/Login.php';
		// Check is user is admin
		include 'admincheck.php';
		?>

  
  	<?php 
  		include 'adminmenu.php';
  	?>
  <p>
  	<strong>Admin Home</strong>
  	<i>If you cannot see the menu, use the buttons below</i>
  	<hr>
  	
    <li><a href="addapp.php">Add a software or app</a></li>
    <li><a href="upload.php">Upload a file</a></li>
    <li><a href="posts.php">Remove apps</a></li>
    <li><a href="settings.php">Change settings</a></li>
    <li><a href="pluginsettings.php">Manage plugins</a></li>
    <li><a href="pageedit.php">Add a page</a></li>
    <li><a href="login/index.php?logout">Logout</a></li>
  
  	</hr>
  	
  	 
  
 
  
  </body>
  </html>