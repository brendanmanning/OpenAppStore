<?php
	/* ^^^^^^^^ Return Type Structure ^^^^^^^^ */
	/* type: qwerty
	   title: blah
	   description: blah blah blah
	   link: 7293file.exe
	*/
	/* ^^^^^^^^ Error Return Types ^^^^^^^^ */
	// e500 - Error
	// e501 - Invalid
	$error = "e500";
	$invalid = "e501";
	if(isset($_GET['appid'])) {
		// Include post getter
		include 'api-post.php';
		echo getPostInfo($_GET['appid']);
	} else if(isset($_GET['list'])) {
		// Include homepage getter
		include 'api-list.php';
		if(isset($_GET['limit'])) {
			echo returnList($_GET['limit']);
		} else {
			echo returnList(15);
		}
	} else {
		// Return an invalid error
		echo $error;
	}
?>
	
	