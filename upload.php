<?php
	include 'ssl.php';
?>
<html>
	<head>
		<title>Upload | <?php
					require_once 'config.php';
					echo TITLE;
				?>
				</title>
				
		
		<!-- Add the basic style HTML -->
		<style>
		
		@media (min-width: 979px) {
   			 body {
				padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
			}
		}
	</style>
	<?php
		include 'css.php';
	?>
	
	</head>
	
	<body>
	<?php
		include 'menu.php';
	?>
	<!-- Show the UI components, including textboxes, forms and text -->
	
	<form action="fileupload.php" method="POST" enctype="multipart/form-data">
		
<center><i><h3>Choose a file: </h3></i><input type="file" name="file" class="btn btn-default">
		
			<br>
			<input type="submit" value="Upload" class="btn btn-primary">
		</center>
	</form>

	</body>
</html>