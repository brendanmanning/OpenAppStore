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
  	<strong>ADMIN AREA</strong>
  	Use the menu options above to perfome admin actions!
  </p>