<?php
	$app = $_GET['a'];
	echo $app;
	if($app != "") {
		if($app != "*") {
			if($app != " ") {
				// Ensure the admin is logged in
				require_once("login/classes/Login.php");
				include 'admincheck.php';
				// Checked that the app name is safe to run in the db
				// Include the db info
				require 'db.php';
				$conn = new mysqli($host, $user, $pass, $database);
				
				if($conn->connect_error) {
					header("Location: index.php?error");
					die("");
				}
				$app = str_replace(";", "NOTALLOWED", $app);
				require 'db.php';
				$sql = "SELECT * FROM `openappstore` WHERE `app` = '" . $app . "' LIMIT 1";
				//$sql = "SELECT * FROM `openappstore` WHERE `app` = '$a';";
				//echo $sql;
				/* Do the actual command */
				$idToDelete;
				$result = $conn->query($sql);
				$newSQL = "";
				if($result->num_rows > 0) {
					//print a box for the app
					while($row = $result->fetch_assoc()) {
						if($row['id'] != null && $row['id'] != "") {
							$newSQL = "DELETE FROM `openappstore` WHERE id = " . $row['id'];
						} else {
							die("SQL ERROR");
						}
					}
					
				}
				
				// Now execute the new sql
				$result = $conn->query($newSQL);
				if(!result) {
					header("Location: index.php?error");
				} else {
					header("Location: index.php?success");
				}
		  		 } else {
		   			echo("e3");
		   		}
	 		 } else {
	  	echo("e2");
	  }
   } else {
   	echo("e1");
   }
?>