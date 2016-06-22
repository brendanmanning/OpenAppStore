<?php
	function returnList($limit) {
		// Require the database config file
		include 'db.php';
		// Create a MySQL connection
		include 'database.php';
		$conn = new mysqli($host, $user, $pass, $database); // Create a database connection so we can escape the string
		// Run a database query and get the result
		$result = database("SELECT * FROM `openappstore` ORDER BY `date` DESC LIMIT " . mysqli_real_escape_string($conn, $limit) . ";");
		// Close the connection, it's no longer needed
		$conn->close();
		// Create the output variable
		$output = "";
		// Create the post separator
		$psep = "|";
		// Create the key/value separator
		$sep = "~";
		if($result != null) {
			while($row = $result->fetch_assoc()) {
				$output .= "id" . $sep . $row['id'] . $sep;	
				$output .= "title" . $sep . $row['app'] . $psep;
			}
		} else {
			return "e500";
		}	
		
		return $output;
	}
?>