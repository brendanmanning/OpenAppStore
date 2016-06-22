<?php
	/* Returns information about a post into vsapi (Very Simple API) format */
	function getPostInfo($id) {
		// This is the separator for keys and values
		$sep = "~";
		// This is the separator for key/value pairs
		$psep = "|";
		// This function needs to Retrieve information from the database
		// So include the database config file first
		include 'db.php';
		include 'config.php'; //needed later
		// Create a MySQL Connection
		$conn = new mysqli($host, $user, $pass, $database);
		if($conn->connect_error) {
			// If the connection to database fails, return a 500 error
			return "e500";
		}
		// Setup the SQL Query
		$sql = "SELECT * FROM `openappstore` WHERE `id` = " . $id . ";";
		// Run the query
		$result = $conn->query($sql);
		// Create a string to hold the result
		$output = "";
		// Create a pair with the string from above
		$nl = $psep;
		// If there are results
		if($result->num_rows > 0) {
			// Work with the data
			while($row = $result->fetch_assoc()) {
				// add the id to api response
				$output .= "id" . $sep . stripChars($row['id']) . $nl;
				// add the title
				$output .= "title" . $sep . stripChars($row['app']) . $nl;
				// Add the description
				$output .= "description" . $sep . stripChars($row['summary']) . $nl;
				// Add the link
				$output .= "link" . $sep . stripChars($row['link']) . $nl;
			}
			
		} else {
			return "e404";
		} 
		
		// Return the output
		return $output;
	}
	
	// This function removes all dangerous characters from results of the database, specifically ==>, because it's the seperator for vsapi 
	function stripChars($string) {
		// Replace the separator string with an escaped version
		return str_replace("~", "{{tilde}}", str_replace("|", "{{vertical_bar}}", $string));
	} 
	