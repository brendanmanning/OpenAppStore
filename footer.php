<div class="row">
        <div class="col-lg-12 target">
            <br class="">
            <br class="">
            <p class="pull-right"><?php
            	require 'login/classes/Login.php';
            	$login = new Login();
            	if($login->isUserAdmin() == true) {
            		echo '<a href="https://github.com/brendanmanning/OpenAppStore" class="">Proudly made with OpenAppStore</a> | <a href="admin.php" class="">Admin Area</a> | <a href="login/index.php?logout">Logout</a></p>';
            	} else {
            		echo '<a href="https://github.com/brendanmanning/OpenAppStore" class="">Proudly made with OpenAppStore</a> | <a href="login/index.php">Admin Login</a></p>';
            	}?>
            <br class="">
            <br class="">
        </div>
    </div>