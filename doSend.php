<?php
	include 'config.php';
	include 'ssl.php';
	// Attempt to send the email
	// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$success = mail(CONTACT, "Comment from " + stripChars($_POST['name']), "<strong>Subject: " . $_POST['subject'] . "</strong><br>" . $_POST['message'] . "<br><i>Sent on " . date('l jS \of F Y h:i:s A') . "</i> by <strong>" . $_POST['name'] . "</strong><br>" . $_POST['name'] . "'s email: " . $_POST['email'], $headers);
	if($success) {
		header("Location: index.php?success");
		die("");
	} else {
		header("Location: index.php?error");
		die("");
	}
	
	function stripChars($i) {
		return str_replace("<", "&lt;", $i);
	}