
<html>
<head>
	<title>Setup Database</title>
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
		// Checks if the salt is long enough
		function checkSaltLength() {
			if(document.getElementById())
		}
		function isOk() {
			// Called by submit button
			// If this returns false, the form won't submit
			
		}
	</script>
</head>

<body>
<?php
	include "menu.php";
?>
<div class="container">
     <h1 class="" contenteditable="false">Install OpenAppStore!</h1>
	<h4 class=""><i>Enter database details below!</i></h4>
<form action="createdatabase.php" method="POST">
<input type="text" name="host" placeholder="Database Host" class="form-control" required><br>
<input type="text" name="user" placeholder="MySQL User" class="form-control" required><br>
<input type="password" name="pass" placeholder="Database Password" class="form-control" required><br>
<input type="hidden" name="ref" value="setup.php">
<input type="text" name="db" placeholder="Database Name" class="form-control" required>
<hr>
<input type="password" name="adminPass" class="form-control" placeholder="Your login password (username is ADMIN)" required>
<br>
<input type="email" name="adminMail" placeholder="Your email" class="form-control" required>
<br>
<hr>
<input type="text" name="salt" placeholder="Type random characters. Will be used to make the database more secure" onupdate="checkSaltLength()" class="form-control" id="salt" required> <p>Minimum 16 characters</p>
<input type="submit" value="INSTALL!" class="btn btn-primary" onsubmit="return isOk()">
</form>
</div>
</body>
</html>
