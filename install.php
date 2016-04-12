<html>
	<head>
		<title>Install <?php 
					echo $_GET['a'];
						?>
		</title>
		<?php
			include 'css.php';
		?>
		<style>
			body {
  padding-top: 50px;
}
</style>


	
	

	</head>
	
	<body>
		
		<?php
			include "menu.php";
		?>
			
			

<div class="container">
  
  <div class="text-center">
    <h1>Install 
    
    <?php 
    	echo $_GET['a'];
    	?>
    </h1>
   <?php /*
    <p class="lead"><i>Run this command in jLinux.</i><br></p>
  <input type="text" class="form-control input-xl" value=
  
  <?php 
  	require_once 'config.php';
  	$app = $_GET['a'];
  	echo "'" . PREFIX . strtolower($app) . "'";
  ?>>*/
  ?>
 
  <?php
  
  	require_once 'db.php';
  	require_once 'config.php';
	$conn = new mysqli($host, $user, $pass, $database);
	
	if($conn->connect_error) {
		die("<center><h2><strong>Apps failed to load</strong></h2><h3><i>Please try again later ðŸ˜ž</i></h3></center></body></html>");
	}
	$a = str_replace(";", "NOTALLOWED", $_GET['a']);
	$sql = "SELECT * FROM `openappstore` WHERE `app` = '$a';";
	//echo $sql;
	/* Do the actual command */
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
		//print a box for the app
		while($row = $result->fetch_assoc()) {
			$a = str_replace("'", "\'", $a);
			$d = str_replace("'", "\'", $d);
			$l = str_replace("'", "\'", $l);
		
			echo '<a href="' . URL . "content/" . $row['link'] . '" class="btn btn-default">Download ' . $row['app'] . ' Now!</a>';
			echo '<hr class="">';
			echo '<center><h3><strong>What is ' . $a . '?</strong></h3>';
			echo '<i>' . $row['summary'] . '</i></center>';
			//echo 
	} 
	} else {
		echo '<h2>No Results</h2>';
}
	
?>
  </div>
  <?php
  	include 'footer.php';
  ?>
</div><!-- /.container -->

</body>
</html>