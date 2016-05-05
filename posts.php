<html>
	<head>
		<?php include 'css.php'; ?>
		<title> Admin | <?php include 'material.php'; echo TITLE;?></title>
	</head>
	<body>
	<?php
		//Check if admin
		// Require login class
		require_once("login/classes/Login.php");
		$login = new Login();
		if($login->isUserAdmin() == false) {
			die('<center> <h1><a href="login/index.php">Please login first</a></h1></center>');
		}
		
	?>
	<ul>
	<?php
	require 'db.php';
	require 'config.php';
	$conn = new mysqli($host, $user, $pass, $database);
	if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
	} 
	$sql = "SELECT * FROM `openappstore` ORDER BY `date` DESC LIMIT 100";
	/* Do the actual command */
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
		//print a box for the app
		while($row = $result->fetch_assoc()) {
			echo "<li>";
			// fill list item
			echo "<strong>" . $row['app'] . "</strong>...<i>Posted on </i>" . $row['date'] . " <i class='material-icons right'>delete</i> <a class='btn waves-effect waves-light' href='removepost.php?a=" . $row['app'] . "'>DELETE</a>";
			echo "</li>";
		}
	} else {
		echo "ERROR";
	}