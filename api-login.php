<?php
	// Grab the password from post
	$pass = $_POST['pwd'];
	// Require the database class
	require_once 'medoo.php';
	// Require the database config file
	require_once 'db.php';
	// Initilize db connection
	$database = new medoo([
   	 'database_type' => 'mysql',
   	 'database_name' => $database,
   	 'server' => $host,
   	 'username' => $user,
   	 'password' => $pass,
   	 'charset' => 'utf8'
	]);
	// Create the device's uuid. it will be linked to it's pin. The device will retrieve this uuid from reading the contents of the url this file returns
	$uuid = md5(uniqid(rand(1000000,10000000), true));
	$pin = rand(100000, 999999);
	//Put the data in the database
	$database->insert('openappstorecodes', [
   	 'code' => $pin,
   	 'valid' => false,
   	 'comp_id' => $uuid
	]);
	// Return the created uuid and pin
	echo $uuid;
	echo "<br>";
	echo $pin;
?>
 