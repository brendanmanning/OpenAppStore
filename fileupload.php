<?php
	$errors = "";
    include 'admincheck.php';
	/* Take and upload the user's file */
	
	/* If a file was uploaded */
	if($_FILES['file']['name']) {
		/* Do something with the file */
		if(!$_FILES['file']['error']) {
			if(isset($_POST['isPlugin'])) {
				$newFileName = $_FILES['file']['name'];
			} else {
				$newFileName = strtolower(rand(100,10000) . $_FILES['file']['name']); /* Create a temporary file name and append a random number */
			}
			
			if($_FILES['file']['size'] > 1000000000) { //if file is bigger than a GB
				echo "<script>alert('Sorry. Files can't be above 1GB')</script>";
				header("Location: index.php?error=1");
				die("ERROR");
				/* Catch this in case execution of script continues for some reason */
			}
			/* otherwise, continue*/
			if(!isset($_POST['isPlugin'])) {
				move_uploaded_file($_FILES['file']['tmp_name'], "content/" . $newFileName);
			} else {
				move_uploaded_file($_FILES['file']['tmp_name'], "plugins/" . $newFileName);
			}
			/* Move the file */
			echo "ALL GOOD!";
			/* The above message should never show, because now we will redirect to the addapp page where the user
			can enter information for the file and post it as an app */
			if(!isset($_POST['isPlugin'])) {
				header("Location: addapp.php?f=" . $newFileName);
			}
			
		} else {
			/* Send to error page */
			header("Location: index.php?error=1");
		}
	} else {
		/* handle no file error */
		echo "ERROR";
	}
	
	
	// If it was a plugin, unzip it and delete the archive
	if(isset($_POST['isPlugin']))
	{
		$zip = new ZipArchive;
		if ($zip->open("plugins/" . $newFileName) === TRUE) {
    			$zip->extractTo("plugins/" . preg_replace('/\\.[^.\\s]{3,4}$/', '', $newFileName) . ".plugin");
   			 $zip->close();
		 	   echo 'ok';
		} else {
  			  $errors .= '<br>ZIP extraction failed! Things to check <li>That the file actually is a ZIP file</li><li>That the file was uploaded properly</li><li>That file uploads are enabled in your PHP settings</li>';
		}	
		
		
		if(!unlink("plugins/" . $newFileName)) {
		 	   	$errors .= "<br>Could not delete ZIP file (" . "plugins/" . $newFileName . ")";
		}
		
		if($errors == "") { header("Location: index.php?success"); } else { die("The following errors were enoucntered while uploading your file: " . $erros); }
	}
	
	?>