<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>jLinux Appstore</title>

<?php
	include "css.php";
?>

<style>
@import url(http://fonts.googleapis.com/css?family=Antic+Slab);

html,body {
  height:100%;
}

h1 {
  font-family: 'Antic Slab', serif;
  font-size:80px;
  color:#DDCCEE;
}

.lead {
	color:#DDCCEE;
}


/* Custom container */
.container-full {
  margin: 0 auto;
  width: 100%;
  min-height:50%;
  background-color:#110022;
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
	/* check if OpenAppStore is installed */
	if(file_exists("setup.php")) {
		header("Location: setup.php");
	}	
?>
<?php
	/* add the menu */
	include "menu.php";
?>
<div class="container-full">
    <div class="row target">
        <div class="col-lg-12 text-center v-center">
             <h1 class="" contenteditable="false"><?php
             	require_once 'config.php';
             		echo TITLE;
             		?></h1>

            <p class="lead">	<?php 
            				require_once 'config.php';
            				echo SUBTITLE;
           			?>
            </p>
            <br class="">
            
        
        </div>
    </div>
    <!-- /row -->
    <br class="">
    <br class="">
    <br class="">
    <br class="">
    <br class="">
</div>


<!-- /container full -->

<!-- /show container for app squares before making them -->
<div class="container">
    <hr class="">
    <div class="row">
<?php
	require_once 'db.php';
	$conn = new mysqli($host, $user, $pass, $database);
	
	if($conn->connect_error) {
		die("<center><h2><strong>Apps failed to load</strong></h2><h3><i>Please try again later 😞</i></h3></center></body></html>");
	}
	
	if($_GET['limit'] == 10) {
		$sql = "SELECT * FROM `openappstore` ORDER BY `date` DESC LIMIT 30";
	} else if($_GET['limit'] == 30) {
		$sql = "SELECT * FROM `openappstore` ORDER BY `date` DESC LIMIT 30";
	} else if($_GET['limit'] == "all") {
		$sql = "SELECT * FROM `openappstore` ORDER BY `date` DESC";
	} else {
		$sql = "SELECT * FROM `openappstore` ORDER BY `date` DESC LIMIT 15";
	}
	/* Do the actual command */
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
		//print a box for the app
		while($row = $result->fetch_assoc()) {
			$a = str_replace("'", "\'", $a);
			$d = str_replace("'", "\'", $d);
			$l = str_replace("'", "\'", $l);
		
			echo '<div class="col-md-4">
           			 <div class="panel panel-default">
               			 <div class="panel-heading">
                  		<h3 class="">' . $row['app'] . ' | <a href="install.php?a=' . $row['app'] . '">Install ' . $row['app'] . '</a></h3>
                  
                  
                </div>
                <div class="panel-body">' . $row['summary'] . '</div>
            </div>
        </div>';
	}
}
	

?>        
    <div class="row">
        <div class="col-lg-12 target">
            <br class="">
            <br class="">
            <p class="pull-right"><a href="https://github.com/brendanmanning/OpenAppStore" class="">Proudly made with OpenAppStore</a> | <a href="addapp.php" class="">Admin Area</a></p>
            <br class="">
            <br class="">
        </div>
    </div>
</div>
<?php
	if($_GET['success'] == 1) {
		echo "<script>alert('Success!')</script>";
	}
?>
</body>
</html>