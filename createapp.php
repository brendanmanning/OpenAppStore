<?php
	
    include 'admincheck.php';
	
	$a = $_POST['name'];
	// Replace colons in app name
	$a = str_replace(";", "_", $a);
	$a = str_replace("'", "_", $a);
	$a = str_replace("`", "_", $a);
	$a = str_replace("~", "_", $a);
	$a = str_replace("<", "_", $a);
	$d = $_POST['summary'];
	$d = strip_tags($d, ALLOWEDHTML);
	$l = $_POST['location'];
	$l = str_replace("<", "_", $l);
	
	
	
	/* Upload the screenshots */
	
	$total = count($_FILES['filesToUpload']['name']);
	/* String to hold the file names to insert into the database */
	$fileString = "";
	// Loop through each file
	for($i=0; $i<$total; $i++) {
  		//Get the temp file path
  		$tmpFilePath = $_FILES['filesToUpload']['tmp_name'][$i];

 		 //Make sure we have a filepath
 		 if ($tmpFilePath != ""){
  			  //Setup our new file path
  			  $fileName = rand(100, 10000) . $_FILES['filesToUpload']['name'][$i];
   			 
			$fileName = str_replace(" ", "_", $fileName);
			$fileName = str_replace(",", "_", $fileName);
			$fileName = str_replace("`", "_", $fileName);
			$fileName = str_replace(":", "_", $fileName);
			$fileName = str_replace(";", "_", $fileName);
			$fileName = str_replace("'", "_", $fileName);
			$fileName = str_replace('"', "_", $fileName);
			$fileName = str_replace("+", "_", $fileName);
			$fileName = str_replace("=", "_", $fileName);
			
			$newFilePath = "img/" . $fileName;
    			//Upload the file into the temp dir
   			 if(move_uploaded_file($tmpFilePath, $newFilePath)) {

     				 //Now the files are uploaded, so insert them into the database
     				 if($i > 0) {
      					$fileString .= ",";
      				}
      				$fileString .= $fileName;

    			}
  		}
	}

	
	
	
	
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
		$original = mysqli_real_escape_string($conn, $_POST['original']);
		$changes = mysqli_real_escape_string($conn, $_POST['changes']);
		$version = mysqli_real_escape_string($conn, $_POST['version']);
		$a = mysqli_real_escape_string($conn, $a);
		$d = mysqli_real_escape_string($conn, $d);
		$l = mysqli_real_escape_string($conn, $l);
		if($_POST['original'] == "none") {
			$sql = "INSERT INTO `" . $database . "`.`openappstore` (`app`, `summary`, `link`, `screenshots`) VALUES ('". $a . "', '" . $d . "', '" . $l . "', '" . $fileString . "');";
		} else {
			if(!isset($version)) {
				die("Must have a version #");
			}
			$sql = "INSERT INTO `openappstoreversions` (appid,version,changes,file) VALUES ('" . $original . "','" . $version . "','" . $changes . "','" . $l . "');";
		}
		if ($conn->query($sql) === TRUE) {
   			 //echo "Database created successfully";
		} else {
   			 echo "Error creating database: " . $conn->error;
		}
	
$conn->close();
header("Location: index.php?success=1");
?>