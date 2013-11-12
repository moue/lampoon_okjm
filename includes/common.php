<?php
	session_start();
		
	//define database constants
	define("DB_USER","podcast");
	define("DB_PASS","G5FJYPXUiVoe");
	define("DB_HOST","mysql.hcs.harvard.edu");
	define("DB_NAME","podcast");

	//create a DB connection
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die('Could not connect to mysql server.');
	mysql_select_db(DB_NAME);

?>
