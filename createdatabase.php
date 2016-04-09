<?php
	$ok = false;
	$host = $_POST['host'];
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$db = $_POST['db'];
	$ref = $_POST['ref'];
		// Create connection
		$conn = new mysqli($host, $user, $pass, $db);

		// Check connection
		if ($conn->connect_error) {
    			die("Connection failed: " . $conn->connect_error);
		} 
		
		$sql = "CREATE TABLE IF NOT EXISTS `openappstore` (
  `app` text NOT NULL COMMENT 'app title',
  `summary` text NOT NULL COMMENT 'summary of the app''s purpose',
  `link` text NOT NULL COMMENT 'location where the app package will be stored',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
		if ($conn->query($sql) === TRUE) {
   			// echo "Database created successfully";
   			 $ok = true;
		} else {
   			 die("Error creating database: " . $conn->error);
		}

$conn->close();

	if($ok == true) {
		$dbFileStr = '<?php
	$host = "[{host}]";
	$user = "[{user}]";
	$pass = "[{pass}]";
	$database = "[{db}]";
?>';
	$dbFileStr = str_replace("[{host}]", $host, $dbFileStr);
	$dbFileStr = str_replace("[{user}]", $user, $dbFileStr);
	$dbFileStr = str_replace("[{pass}]", $pass, $dbFileStr);
	$dbFileStr = str_replace("[{db}]", $db, $dbFileStr);
	
	$file = fopen("db.php", "w");
	fwrite($file, $dbFileStr);
	}
		 
header("Location: postinstall.php");
	
?>