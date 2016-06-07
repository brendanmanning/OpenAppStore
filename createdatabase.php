<?php
	$ok = false;
	$host = $_POST['host'];
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$db = $_POST['db'];
	$ref = $_POST['ref'];
		// Create connection
		$conn = new mysqli($host, $user, $pass, $db);
		// Check connection
		if ($conn->connect_error) {
    			die("Connection failed: " . $conn->connect_error);
		} 
		
		$sql = "
CREATE TABLE IF NOT EXISTS `openappstore` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app` text NOT NULL COMMENT 'app title',
  `summary` text NOT NULL COMMENT 'summary of the app''s purpose',
  `link` text NOT NULL COMMENT 'location where the app package will be stored',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `screenshots` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;";
		if ($conn->query($sql) === TRUE) {
   			// echo "Database created successfully";
   			 $ok = true;
		} else {
   			 die("Error creating database: " . $conn->error);
		}
	$sql = "CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data' AUTO_INCREMENT=2 ;";
if ($conn->query($sql) === TRUE) {
   			// echo "Database created successfully";
   			 $ok = true;
		} else {
   			 die("Error creating database: " . $conn->error);
		}
        
        $sql = "
CREATE TABLE IF NOT EXISTS `openappstorestatic` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hidden` int(11) NOT NULL,
  `title` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
if($conn->query($sql) === TRUE) {
   // All ok
} else {
   die("ERROR creating openappstorestatic database");
}
$conn->close();
	if($ok == true) {
		$dbFileStr = '<?php
	$host = "[{host}]";
	$user = "[{user}]";
	$pass = "[{pass}]";
	$database = "[{db}]";
?>';
	$dbFileStr = str_replace("[{host}]", $host, $dbFileStr);
	$dbFileStr = str_replace("[{user}]", $user, $dbFileStr);
	$dbFileStr = str_replace("[{pass}]", $pass, $dbFileStr);
	$dbFileStr = str_replace("[{db}]", $db, $dbFileStr);
	
	$file = fopen("db.php", "w");
	fwrite($file, $dbFileStr);
	}
fclose($file);
    // Now add database details to the login config
    $loginDBfile = '<?php
/**
 * Configuration for: Database Connection
 *
 * For more information about constants please @see http://php.net/manual/en/function.define.php
 * If you want to know why we use "define" instead of "const" @see http://stackoverflow.com/q/2447791/1114320
 *
 * DB_HOST: database host, usually its "127.0.0.1" or "localhost", some servers also need port info
 * DB_NAME: name of the database. please note: database and database table are not the same thing
 * DB_USER: user for your database. the user needs to have rights for SELECT, UPDATE, DELETE and INSERT.
 * DB_PASS: the password of the above user
 */
$host = "{{host}}";
$user = "{{user}}";
$pass = "{{pass}}";
$database = "{{database}}";
define("DB_HOST", $host);
define("DB_NAME", $database);
define("DB_USER", $user);
define("DB_PASS", $pass);
?>';
// Now write to file
$dbFile = fopen("login/config/db.php", "w");
$loginDBfile = str_replace("{{host}}", $host, $loginDBfile);
$loginDBfile = str_replace("{{user}}", $user, $loginDBfile);
$loginDBfile = str_replace("{{pass}}", $pass, $loginDBfile);
$loginDBfile = str_replace("{{database}}", $db, $loginDBfile);
fwrite($dbFile, $loginDBfile);
fclose($dbFile);
header("Location: postinstall.php");
	
?>