<?php
	include 'ssl.php';
?>
<html>
	<head>
		<title><?php include 'config.php'; echo TITLE; ?></title>
		<?php
			include 'css.php';
		?>
	</head>
	
	<body>
		<?php
			include 'menu.php';
		?>
		if(isset($_GET['id'])) {
			$i = $_GET['id'];	
		} else {
			die("Page not found");
		}
		require_once 'db.php';
  	require_once 'config.php';
	$conn = new mysqli($host, $user, $pass, $database);
	
	if($conn->connect_error) {
		die("<center><h2><strong>Page failed to load</strong></h2><h3><i>Please try again later ðŸ˜ž</i></h3></center></body></html>");
	}
	$a = str_replace(";", "NOTALLOWED", $_GET['a']);
	$sql = "SELECT * FROM `openappstorestatic` WHERE `id` = '$i';";
	//echo $sql;
	/* Do the actual command */
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
		//print a box for the app
		while($row = $result->fetch_assoc()) {
			echo $row['content'];
			echo "<br>";
		}
	
	} else {
		echo '<h2>No Results</h2>';
}


/* Begin code for comment section */

/* First check is commenting is enabled */
if(COMMENTS == true) {
	include 'commentbox.php';
} else {
	/* Comments are disabled */
}
	
	
	</body>
</html>
	