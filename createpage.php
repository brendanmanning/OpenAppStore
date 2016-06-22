<?php
/* Now prepare the MySQL insert */
	/* Include the config file */
	require_once "config.php";
	/* and the database file */
	require_once "db.php";
	// Create connection
	$conn = new mysqli($host, $user, $pass, $database);

	// Check connection
	if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
	} 
		
		// strip_tags($text, '<p><a>');
		 $c = $_POST['content'];
		 $t = $_POST['title'];
		
		$c = mysqli_real_escape_string($conn, $c);
		$t = mysqli_real_escape_string($conn, $t);
		
		
		$sql = "INSERT INTO `" . $database . "`.`openappstorestatic` (`content`, `hidden`, `title`) VALUES ('". strip_tags($c, ALLOWEDHTML) . "', '0', '" . strip_tags($t, ALLOWEDHTML) . "');";
		
		if(isset($_POST['edit'])) {
			if(isset($_POST['edit_id'])) {
				$sql = "UPDATE `openappstorestatic` SET `content` = '" . strip_tags($c, ALLOWEDHTML) . "', `title` = '" . strip_tags($t, ALLOWEDHTML) . "' WHERE `id` = " . mysqli_real_escape_string($conn, $_POST['edit_id']) . ";";
				//echo $sql;
			} else {
				die("error");
			}
		}
		//die($sql);
		if ($conn->query($sql) === TRUE) {
   			 //echo "Database created successfully";
		} else {
   			 echo "Error creating post: " . $conn->error;
		}
	
$conn->close();
header("Location: index.php?success=1");