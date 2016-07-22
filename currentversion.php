<?php
include 'db.php';
$conn = new mysqli($host, $user, $pass, $database);

	// Check connection
	if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
	} 
$sql = "SELECT * FROM `openappstoreversions` WHERE appid=" . mysqli_real_escape_string($conn, $_GET['id']) . " ORDER BY date DESC LIMIT 1;";

$result = $conn->query($sql);
if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		echo "The current version of " . $_GET['name'] . " is <strong>" . $row['version'] . "</strong>";
	}
} else {
	echo "<strong>No results returned</strong>";
}
$conn->close();
?>