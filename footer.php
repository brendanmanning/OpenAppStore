<div class="row">
        <div class="col-lg-12 target">
            <br class="">
            <br class="">
            <p class="pull-right"><?php
            	require 'login/classes/Login.php';
            	$login = new Login();
            	echo '<center>';
            	if($login->isUserAdmin() == true) {
            		echo '<a href="https://github.com/brendanmanning/OpenAppStore" class="">Proudly made with OpenAppStore</a> | <a href="admin.php" class="">Admin Area</a> | <a href="login/index.php?logout">Logout</a></p>';
            	} else {
            		echo '<a href="https://github.com/brendanmanning/OpenAppStore" class="">Proudly made with OpenAppStore</a> | <a href="login/index.php">Admin Login</a></p>';
            	}
            	
            	if($_SERVER['SERVER_PORT']  == 443) {
            		echo '<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">';
            		echo '<hr><i class="material-icons">https</i> <strong>Your connection to this site is secured over HTTPS</strong>';
            	}
            	echo '</center>';
            	?>
            <br class="">
            <br class="">
        </div>
    </div>