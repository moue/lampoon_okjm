<?php
	session_start();
		
	// see flashdrive for db connection pw info

	//create a DB connection
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die('Could not connect to mysql server.');
	mysql_select_db(DB_NAME);

?>
