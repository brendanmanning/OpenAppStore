<html>
	<head>
		<title>Install <?php 
					echo $_GET['a'];
						?>
		</title>
		<?php
			// Require site settings
			include 'config.php';
			include 'css.php';
			require 'login/classes/Login.php';
				$login = new Login();
		?>
		<style>
			body {
  padding-top: 50px;
}
</style>
<?php
if(REQUIREACCOUNT) {
	if($login->isUserLoggedIn() == false) {
		include 'loginoverlaycss.php';
	}
}
?>
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
		
		<?php
		if(REQUIREACCOUNT) {
			if($login->isUserLoggedIn() == FALSE) {
			echo '<script>
		function showLogin() {
			document.getElementById("topmenu").hidden = true;
			document.getElementById("loginview").style.width = "100%";
		}
		
		function closeLogin() {
			location.reload();
		}
		
	</script>';
		}
	}
	?>

	</head>
	
	<body>
		<div id="topmenu">
		<?php
			include "menu.php";
		?>
		</div>	
	<?php
		if(REQUIREACCOUNT) {
			if($login->isUserLoggedIn() == FALSE) {
		echo '
	<div id="loginview" class="overlay">
		<iframe src="login/index.php" allowtransparency="true" style="background: #FFFFFF;" height="90%", width="100%"></iframe>
		<center><a onclick="closeLogin()" class="btn btn-default">Click here to close</a></center>
	</div>';
		}
	}
	?>	

<div class="container">
  
  <div class="text-center">
    <h1>Install 
    
    <?php 
    	echo $_GET['a'];
    	?>
    </h1>
 
  <?php
  
  	require_once 'db.php';
  	require_once 'config.php';
  	
  	
	$conn = new mysqli($host, $user, $pass, $database);
	
	if($conn->connect_error) {
		die("<center><h2><strong>Apps failed to load</strong></h2><h3><i>Please try again later ðŸ˜ž</i></h3></center></body></html>");
	}
	
	$a = mysqli_real_escape_string($conn, $_GET['a']);
	
	$sql = "SELECT * FROM `openappstore` WHERE `app` = '$a';";
	//echo $sql;
	/* Do the actual command */
	$result = $conn->query($sql);
	if($result->num_rows > 0) { 
		//print a box for the app
		while($row = $result->fetch_assoc()) {
		
			/* Check if there are multiple versions of the app */
			$sql = "SELECT * FROM `openappstoreversions` WHERE `appid` = " . mysqli_real_escape_string($conn, $row['id']) . " ORDER BY `date` DESC LIMIT 1;";
			//die($sql);
			$versionResult = $conn->query($sql);
			
			$fileLink = null;
			
			if($versionResult->num_rows > 0) {
				while($r = $versionResult->fetch_assoc()) {
					echo "<i>Version " . $r['version'] . "</i><br>";
					$fileLink = $r['file'];
				}
			}
			//die($versionResult);
		
			$a = str_replace("'", "\'", $a);
			$d = str_replace("'", "\'", $d);
			$l = str_replace("'", "\'", $l);
		
		
			/* Use a plugin if enabled */
			require 'plugincore.php';
			// Call the plugin function. If it returns false (no plugin was run), perform the default action.
			if($fileLink == null) {
				$arr = array($row['app'], $row['link'], $row['summary']);
			} else {
				$arr = array($row['app'], $fileLink, $row['summary']);
			}
			if (runPlugin("DOWNLOAD", $arr) == false) {
				
				
				if($login->isUserLoggedIn() == true) {
				if($fileLink == null) {
					echo '<a href="content/' . $row['link'] . '" class="btn btn-default">';
					} else {
						echo '<a href="content/' . $fileLink . '" class="btn btn-default">';	
					}
					echo '<span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span>'; 
				/* Added cloud download icon above */
				echo ' Download Now!</a>';
				} else {
					if(REQUIREACCOUNT) {
						echo '<a onclick="showLogin()"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span>Login to Download</a>';
					} else {
						if($fileLink == null) {
					echo '<a href="content/' . $row['link'] . '" class="btn btn-default">';
					} else {
						echo '<a href="content/' . $fileLink . '" class="btn btn-default">';	
					}
					echo '<span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span>'; 
				/* Added cloud download icon above */
				echo ' Download Now!</a>';
					}
					
				}
				
			
				
				echo '<hr class="">';
				echo '<center><h3><strong>What is ' . $a . '?</strong></h3>';
				echo '<i>' . $row['summary'] . '</i></center>';
			}
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