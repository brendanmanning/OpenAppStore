<?php
		// Require login class
		require_once("login/classes/Login.php");
		$login = new Login();
		if($login->isUserAdmin() == false) {
			die('<center> <h1><a href="login/index.php">Please login first</a></h1></center>');
		}
		
?>