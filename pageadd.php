<?php
	// Redirect to SSL port if configured
	include 'ssl.php';
	// Check if user is admin
	include 'admincheck.php';
?>
<html>
	<head>
		<title><?php include 'config.php'; echo TITLE?> | Add Page</title>
		<?php 
			// Inlcude material design CSS
			include 'material.php';
		?>
		<script>
			function addA() {
				var lnk = prompt("Destination URL:", "");
				var title = prompt("Link Text:", "");
				if(lnk != "") {
					if(title != "") {
						document.getElementById("post_content").value += "<a href='" + lnk + "'>" + title + "</a>";
					} else {
						alert("Title cannot be empty");
					}
				} else {
					alert("Link cannot be empty");
				}
			}
			
			function bold() {
				if(document.getElementById("boldState").innerHTML == "off") {
					document.getElementById("post_content").value += "<strong>";
					document.getElementById("bold_button").innerHTML = "End Bolded Text";
					document.getElementById("boldState").innerHTML = "on";
				} else {
					document.getElementById("post_content").value += "</strong>";
					document.getElementById("bold_button").innerHTML = "<strong>Add bolded text</strong>";
					document.getElementById("boldState").innerHTML = "off";
				}
			}
		</script>
	</head>
	<body>
	<?php include "adminmenu.php"; ?>
	<h5>
	<?php 
		if(isset($_GET['edit'])) {
			echo "Edit ";
		} else {
			echo "Add "; 
		}
	?>Blog Post</h5>
	<hr>
	<?php
				if(isset($_GET['edit'])) {
					
					require 'db.php';
					$conn = new mysqli($host, $user, $pass, $database);
					if($conn->connect_error) {
		die('<center><h2><strong>Page failed to load</strong></h2><h3><i>Please try again later ðŸ˜ž</i></h3></center></body></html>');
	}
		}		
			?>
	<form action="createpage.php" method="POST">
		<div class"input-field col s6">
        		<i class="material-icons prefix">info_outline</i>
         	 <input id="post_title" type="text" name="title" class="validate" placeholder="Title" value=
         	 <?php
         	 	if(isset($_GET['edit'])) {
         	 	
         	 		$sql = 'SELECT * FROM `openappstorestatic` WHERE `id` = ' . mysqli_real_escape_string($conn, $_GET['edit']) . ' LIMIT 0,2;';
         	 		$result = $conn->query($sql);
         	 		
				if($result->num_rows > 0) {
					
					while($row = $result->fetch_assoc()) {
         	 				echo '"' . $row['title'] . '"';
         	 				$content = $row['content'];
         	 			}
         	 		} else {
         	 			echo '""';
         	 		}	
         	 	}  else {
         	 		echo '""';
         	 	}
         	 ?>
         	 >
         	 </div>
         	 <div class"input-field col s6">
        		<i class="material-icons prefix">description</i>
         	 	<textarea name="content" id="post_content" rows="80" cols="50" class="validate" placeholder="Your page content here...."><?php
         	 		if(isset($_GET['edit'])) {
         	 			echo $content;
         	 		}
         	 	?>
         	 	</textarea>
         	 	</div>
         	 <a onclick="addA()">Add Hyperlink</a> | <a onclick="bold()" id="bold_button"><strong>Add bolded text</strong></a>
         	 <br>
         	 <?php
         	 	if(isset($_GET['edit'])) {
         	 		echo '<input type="hidden" name="edit" value="true">';
         	 		echo '<input type="hidden" name="edit_id" value="' . $_GET['edit'] . '">';
         	 	}
         	 	?>
         	 <input type="submit" value="Submit" class="btn waves">
         	 </form>
         	 <p id="boldState" hidden>off</p>