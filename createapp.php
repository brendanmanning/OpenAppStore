<?php
	/* Get the password from post */
	$pwd = $_POST['pwd'];
	/* Require the password file */
	require_once "pass.php";
	/* Check the two for a match */
	if($pwd != PASSWORD) {
		die("ERROR: Passwords don't match");
	}
	/* Otherwise, assume the user is admin */
	/* Get the POST variables */
	$a = $_POST['name'];
	$d = $_POST['summary'];
	$l = $_POST['location'];
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
		/*//clean colons
		$a = str_replace(";", "&#59;", $a);
		$d = str_replace(";", "&#59;", $d);
		$l = str_replace(";", "&#59;", $l);
		
		//clean script tags
		$a = str_replace("<", "&lt;", $a);
		$d = str_replace("<", "&lt;", $d);
		$l = str_replace("<", "&lt;", $l);
		
		//clean slashes
		$a = str_replace("/", "\/", $a);
		$d = str_replace("/", "\/", $d);
		$l = str_replace("/", "\/", $l);*/
		
		$a = mysqli_real_escape_string($conn, $a);
		$d = mysqli_real_escape_string($conn, $d);
		$l = mysqli_real_escape_string($conn, $l);
		
		$sql = "INSERT INTO `" . $database . "`.`openappstore` (`app`, `summary`, `link`) VALUES ('". $a . "', '" . $d . "', '" . $l . "');";
		//die($sql);
		if ($conn->query($sql) === TRUE) {
   			 //echo "Database created successfully";
		} else {
   			 echo "Error creating database: " . $conn->error;
		}

$conn->close();
header("Location: index.php?success=1");
?>