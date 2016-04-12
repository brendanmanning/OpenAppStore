<?php
	include 'ssl.php';
?>
<html>
<head>
	<title>Add an app</title>
	<?php
		include "css.php";
	?>
	<style>
		
		@media (min-width: 979px) {
   			 body {
				padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
			}
		}
	</style>
</head>

<body>
<?php
	include "menu.php";
?>
<div class="container">
     <h1 class="" contenteditable="false">Add an App!</h1>

    <p class="">Add a new app to <?php
    					require_once "config.php";
    					echo TITLE;
    				?>!
        <br class="">You must upload the file to your webhost first<br><a href="upload.php">Need to upload a file?</a></p>
        
   <form action="createapp.php" method="POST">
    <input type="text"
    placeholder="App title" name="name" class="form-control" contenteditable="true" style="">
  	<br>
    <input type="text" placeholder="App Description" name="summary" class="form-control" contenteditable="true">
    <br>
    <input type="text" placeholder="File Name (inside content folder)" name="location" class="form-control" style="" value=<?php
    													if($_GET['f'] != null) {
    														echo '"' . $_GET['f'] . '"';
    													} else {
    														echo '""';
    													}
    												?>
    	>
    <br>
    <i>Confirm your admin password: </i><input type="password" name="pwd" class="form-control">
    <br>
    <input type="submit" value="Add App!" class="btn btn-primary">
	</form>  
	
	<?php
		include 'footer.php';
	?>  
</div>

<!-- /container -->