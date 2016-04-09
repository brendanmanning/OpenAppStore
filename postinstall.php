<html>
	<head>
		<title>Installed!</title>
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
  color:#052E00;
}

.lead {
	color:#052E00;
}


/* Custom container */
.container-full {
  margin: 0 auto;
  width: 100%;
  min-height:100%;
  background-color:#14BF00;
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
	
	<div class="container-full">

      <div class="row">
       
        <div class="col-lg-12 text-center v-center">
          
          <h1>OpenAppStore Installed Successfully!</h1>
          <p class="lead"><strong>To finish setup, there's two last things to do</strong><br>
          	1. Edit pass.php to set your own password<br>
            2. Delete the following files: setup.php, createdatabase.php, postinstall.php
          
          </p>
          
          <br>
          
          <a href="https://www.github.com/brendanmanning/OpenAppStore" class="btn btn-info">View the source code</a> 
          <a href="index.php" class="btn btn-success">Visit your new site!</a>
          <br>
          <br><center>
          <p class="">OpenAppStore ©Copyright 2016 Brendan Manning</p></center>
        </div>
        
      </div> <!-- /row -->
  
 




  
	
</div>
</body>
</html>