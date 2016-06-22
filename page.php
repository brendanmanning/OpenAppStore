<?php
	include 'ssl.php';
?>
<html>
	<head>
		<title><?php include 'config.php'; echo TITLE; ?></title>
		<?php
			include 'css.php';
			echo '<br><!--END CSS IMPORT CODE-->';
		?>
		
		<style>
@import url(https://fonts.googleapis.com/css?family=Antic+Slab);

html,body {
  height:100%;
}

h1 {
  font-family: 'Antic Slab', serif;
  font-size:80px;
  color:#0C01FF;
}

.lead {
	color:#0C01FF;
}


/* Custom container */
.container-full {
  margin: 0 auto;
  width: 100%;
  //min-height:50%;
  background-color:
  #FF9500;
  color:#eee;
  overflow:hidden;
}

.container-full a {
  color:#efefef;
  text-decoration:none;
}

.v-center {
  margin-top:7%;
}
</style>
	</head>
	
	<body>
		<?php
			include 'menu.php';
			echo '<br><!--END MENU IMPORT CODE-->';
		?>
		<div id="container-full">
		<?php
		
		if(isset($_GET['id'])) {
			$i = $_GET['id'];	
		} else {
			die("Page not found");
		}
		
		require_once 'db.php';
  	require_once 'config.php';
	$conn = new mysqli($host, $user, $pass, $database);
	
	if($conn->connect_error) {
		die("<center><h2><strong>Page failed to load</strong></h2><h3><i>Please try again later ðŸ˜ž</i></h3></center></body></html>");
	}
	$a = str_replace(";", "NOTALLOWED", $_GET['a']);
	$sql = "SELECT * FROM `openappstorestatic` WHERE `id` = " . mysqli_real_escape_string($conn, $i) . " AND `hidden` = '0' LIMIT 0,2;";
	
	//echo $sql;
	/* Do the actual command */
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
		//print a box for the app
		while($row = $result->fetch_assoc()) {
			echo '<!-- Page content start -->';
			echo '<hr>';
			echo '<h4><center>' . $row['title'] . '</center></h4>';
			echo '<hr>';
			echo $row['content'];
			echo "<br>";
			
		}
	
	} else {
		echo '<h2>No Results</h2>';
}


/* Begin code for comment section */

/* First check is commenting is enabled */
if(COMMENTS == true) {
	include 'commentbox.php';
} else {
	/* Comments are disabled */
}
	
	?>
	</div>
	</body>
</html>
	