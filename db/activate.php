<?php
  session_write_close();
  
  require("../includes/common.php");
  
	$nid = mysql_real_escape_string($_GET['nid']);

	/* select current active profile
	$csql = sprintf("SELECT * FROM forum WHERE active=1");
 	$cquery = mysql_query($csql);
 	$crow = mysql_fetch_assoc($cquery);
 	
 	// make inactive
 	$current = $crow['name'];
	$isql = sprintf("UPDATE forum SET active=0 WHERE name='$current' ");	
	$iquery = mysql_query($isql);
	*/
	
	$isql = sprintf("UPDATE forum SET active=0 WHERE active=1");	
	$iquery = mysql_query($isql);
		
	// activate new profile
	$fsql = sprintf("UPDATE forum SET active=1 WHERE nid=$nid ");	
	$fquery = mysql_query($fsql);
	
	header('Location: ../index.php');
?>
