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

	<script>
		/* JavaScript code for screenshot gallery */
		function back() {
			/* Get the current picture */
			var currentPic = document.getElementById("picNum").innerHTML;
			
			var pics = document.getElementById("pictures").innerHTML;
			pics = pics.split(",");
			var currentIndex = currentPic - 1;
			//don't use current pick after this point
			var toShow = currentIndex - 1;
			/*if(currentIndex == 0) {
				toShow = pics.length;
			}
			
			if(currentIndex == pics.length) {
				toShow = 0;
			}
			*/
			if(toShow == -1) {
				toShow = pics.length - 1;
			}
			document.getElementById("image").src = "img/" + pics[toShow];
			document.getElementById("picNum").innerHTML = toShow + 1;
			
			
		}
		
		function nextPic() {
			/* Get the current picture */
			var currentPic = document.getElementById("picNum").innerHTML;
			
			var pics = document.getElementById("pictures").innerHTML;
			pics = pics.split(",");
			var currentIndex = currentPic - 1;
			//don't use current pick after this point
			var toShow = currentIndex + 1;
			/*if(currentIndex == 0) {
				toShow = pics.length;
			}
			
			if(currentIndex == pics.length) {
				toShow = 0;
			}
			*/
			if(toShow == pics.length) {
				toShow = 0;
			}
			document.getElementById("image").src = "img/" + pics[toShow];
			document.getElementById("picNum").innerHTML = toShow + 1;
			
		
		
		}
	</script>
	
	

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
		
			echo '<a href="' . URL . "content/" . $row['link'] . '" class="btn btn-default">';
			echo '<span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span>'; 
			/* Added cloud download icon above */
			
			echo ' Download ' . $row['app'] . ' Now!</a>';
			echo '<hr class="">';
			echo '<center><h3><strong>What is ' . $a . '?</strong></h3>';
			echo '<i>' . $row['summary'] . '</i></center>';
			//echo 
			
			/* Now check to see if there's any screenshots for that app */
			if($row['screenshots'] != null) {
			/* If there are */
			echo '<hr><h2>Pictures:</h2>';
			
			/* echo the gallery controls */
			echo '<button class="btn btn-success" onclick="back()"><- Back</button>';
			echo ' <button class="btn btn-success" onclick="nextPic()">Next -></button>';
			echo '<br>';
			echo '<br>';
			/* This creates a hidden pharagraph that JavaScript uses to get the current picture of the gallery */
			echo '<p id="picNum" hidden>1</p>';
			
				$shots = explode(",", $row['screenshots']);
				$pics = "";
				/* Create the img view */
			echo '<img class="img-thumbnail" id="image" src="img/'. $shots[0] .'" alt="' . $_GET['a'] . '" width="350" height="240"><br>';
				for($i = 0; $i < count($shots); $i++) {
					//echo '<i>Picture #' . ($i + 1) . '</i><br>';
					//echo '<img class="img-thumbnail" id="image" src="img/'. $shots[$i] .'" alt="Chania" width="350" height="240"><br>';
					
					//Create a string for another hidden <p> tag for javascript to get a list of all images 
					if($i != 0) {
						$pics .= ",";
						//add the comma only if it's not the first loop
					}
					$pics .= $shots[$i];
					
				}
				
				/* Once all images are added to the text, output it */
				echo '<p id="pictures" hidden>' . $pics . '</p>';
			}
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
  <?php
  	include 'footer.php';
  ?>
</div><!-- /.container -->

</body>
</html>