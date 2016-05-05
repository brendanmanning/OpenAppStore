<?php
	
    include 'admincheck.php';
	/* Take and upload the user's file */
	
	/* If a file was uploaded */
	if($_FILES['file']['name']) {
		/* Do something with the file */
		if(!$_FILES['file']['error']) {
			$newFileName = strtolower(rand(100,10000) . $_FILES['file']['name']); /* Create a temporary file name and append a random number */
			if($_FILES['file']['size'] > 1000000000) { //if file is bigger than a GB
				echo "<script>alert('Sorry. Files can't be above 1GB')</script>";
				header("Location: index.php?error=1");
				die("ERROR");
				/* Catch this in case execution of script continues for some reason */
			}
			/* otherwise, continue*/
			move_uploaded_file($_FILES['file']['tmp_name'], "content/" . $newFileName);
			/* Move the file */
			echo "ALL GOOD!";
			/* The above message should never show, because now we will redirect to the addapp page where the user
			can enter information for the file and post it as an app */
			header("Location: addapp.php?f=" . $newFileName);
			
		} else {
			/* Send to error page */
			header("Location: index.php?error=1");
		}
	} else {
		/* handle no file error */
		echo "ERROR";
	}