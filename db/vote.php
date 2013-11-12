<?php
  
  require("includes/common.php");
  
  // grab id 
  $nid = mysql_real_escape_string($_POST['nid']);
  
  // select submission with matching id
  $dsql = mysql_query("SELECT * FROM forum WHERE nid=$nid");
  $drow = mysql_fetch_array($dsql);
  
  // increment current vote amount by 1
  upvote = $drow['votes'] + 1;
   
  $sql = sprintf("UPDATE forum SET votes=$upvote WHERE nid=$nid");  	
  $query = mysql_query($sql);
	
	// echo new vote amount
	echo $upvote;
		
?>
