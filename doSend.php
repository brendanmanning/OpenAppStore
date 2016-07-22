<?php
	include 'config.php';
	include 'ssl.php';
	// Attempt to send the email
	// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$success = mail(CONTACT, "Comment from " . strip_tags($_POST['name']), "<strong>Subject: " . strip_tags($_POST['subject']) . "</strong><br>" . strip_tags($_POST['message']) . "<br><i>Sent on " . date('l jS \of F Y h:i:s A') . "</i> by <strong>" . strip_tags($_POST['name']) . "</strong><br>" . strip_tags($_POST['name']) . "'s email: " . strip_tags($_POST['email']), $headers);
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