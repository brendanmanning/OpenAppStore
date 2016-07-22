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
	
	
	<script>
		function changed() {
			var e = document.getElementById("selector");
			
			if(e.options[e.selectedIndex].value != "none") {
				document.getElementById("versioninfo").hidden = false;
				document.getElementById("apptitle").value = "(Not Applicable)";
				document.getElementById("appdesc").value = "(Not Applicable)";
			} else {
				document.getElementById("versioninfo").hidden = true;
				if(document.getElementById("apptitle").value == "(Not Applicable)") {
					document.getElementById("apptitle").value = "";
				}
				if(document.getElementById("appdesc").value == "(Not Applicable)") {
					document.getElementById("appdesc").value = "";
				}
			}
			
		}
		
		function helpversions() {
			var e = document.getElementById("selector");
			if(e.options[e.selectedIndex].value != "none") {
				OpenInNewTab("currentversion.php?id=" + e.options[e.selectedIndex].value + "&name=" + e.options[e.selectedIndex].innerHTML);
			}
		}
		
		function OpenInNewTab(url) {
  var win = window.open(url, '_blank');
  win.focus();
}	
	</script>
</head>

<body>
<?php
	include "menu.php";
	
	// Check if admin
	include 'admincheck.php';
?>
<div class="container">
     <h1 class="" contenteditable="false">Add an App!</h1>

    <p class="">Add a new app to <?php
    					require_once "config.php";
    					echo TITLE;
    				?>!
        <br class="">You must upload the file to your webhost first<br><a href="upload.php">Need to upload a file?</a></p>
        
   <form action="createapp.php" method="POST" enctype="multipart/form-data">
    <input type="text"
    placeholder="App title" id="apptitle" name="name" class="form-control" contenteditable="true" style="" required>
  	<br>
    <input type="text" id="appdesc" placeholder="App Description" name="summary" class="form-control" contenteditable="true" required>
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
  	Is this an update to an existing app? If so, select which one
  	<br>
  	
  	<select name="original" id="selector" required onchange="changed()">
  	<option value="none">None</option>
  	<?php
  		require 'db.php';
  		$conn = new mysqli($host, $user, $pass, $database);
	
	if($conn->connect_error) {
		die("<center>AN ERROR OCCURED DO NOT USE THIS FORM NOW</center></body></html>");
	}
	
	$sql = "SELECT * FROM `openappstore` WHERE 1";
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo '<option value="' . $row['id'] . '">' . $row['app'] . '</option>';
			echo "<br>";
		}
	}
	?>
  	</select>
  	<br>
  	<div id="versioninfo" hidden>
  	<br>
  		<input type="text" placeholder="Changes in this version" name="changes" class="form-control" contenteditable="true">
  		<br>
  		<input type="text" placeholder="Version Number" name="version" class="form-control" contenteditable="true"> <a onclick="helpversions()">Whats the current version?</a>
  	</div>
    <br>
    <i>Add Screenshots of your app (optional)</i>
    <input name="filesToUpload[]" id="filesToUpload" type="file" multiple=""/>
   <br> 
   
    <input type="submit" value="Add App!" class="btn btn-primary">
	</form>  
	
	<?php
		include 'footer.php';
	?>  
</div>

<!-- /container -->