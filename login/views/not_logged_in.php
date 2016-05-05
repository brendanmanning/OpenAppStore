<?php
// show potential errors / feedback (from login object)
if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
            echo $error;
        }
    }
    if ($login->messages) {
        foreach ($login->messages as $message) {
            echo $message;
        }
    }
}
?>
<head>
	<?php
		include '../material.php'; //include material design css
	?>
	<title>Login | <?php include '../config.php'; echo TITLE;?></title>
</head>
<!-- login form box -->
<form method="post" action="index.php" name="loginform">
	
           
    
 
 <i class="material-icons prefix">account_circle</i><strong>Username</strong><br> <input id="login_input_username" class="login_input" type="text" name="user_name" required /> 
<i class="material-icons prefix">lock_outline</i><strong>Password</strong><br> 
    <input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required />

    <input type="submit" class="btn waves-effect" name="login" value="Log in" />
</form>

<a href="register.php">Register new account</a>