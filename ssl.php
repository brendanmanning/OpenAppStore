<?php
	/* Before anything, check if we should be forcing SSL or disabling it */
	require_once 'config.php';
	if(SSL == true) {
		/* Redirect the user to the ssl page if it disabled */
		if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on') {
    			header("Location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
		}
	}
	
	if(SSL == false) {
		/* Redirect the user from the ssl page if it disabled */
		if (isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == 'on') {
    			header("Location: http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
		}
	}
?>