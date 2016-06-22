<?php
	/* databases.php is the new file that will be used to connect to a database. Creating a new connection in every file is ineffieicnt, so simply calling $result = database() will eliminate all that */
	function database($query) {
		include 'db.php';
		include 'config.php'; //needed later
		// Create a MySQL Connection
		$conn = new mysqli($host, $user, $pass, $database);
		if($conn->connect_error) {
			// If the connection to database fails, return a 500 error
			return null; // return null on error
		}
		// Setup the SQL Query
		$sql = $query;
		// Run the query
		$result = $conn->query($sql);
		// Create a string to hold the result
		$output = "";
		// Create a pair with the string from above
		$nl = $psep;
		$conn->close();
		// If there are results
		
		if($result->num_rows > 0) {
			return $result; // return results on success
		} else {
			return null; // Return null on error
		}
	}
?>