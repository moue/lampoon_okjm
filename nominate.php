<?php
  
  require("includes/common.php");
  
	$inputName = mysql_real_escape_string($_POST['username']);
	
	function clean($string) {
	   $string = str_replace(" ", "", $string); // remove all spaces.
	   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

	   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
	}
	
	$input = clean($inputName);
	  	
	exec("/home/groups/podcast/bin/python nominate.py $input", $output);

	$result = json_decode($output[0], true);		
	if($output[0] == 'error')
		print_r($output[0]);
	else {	
		$result = json_decode($output[0], true);	
		
		$name = $result['name'];
		$pic = $result['pic'];
		$src = $result['src'];
		$details = $result['details'];
		$summary = base64_encode($result['summary']);
		$everything = base64_encode($result['everything']);
		
		if($name==="<")
			exit('error');
			
		// check for duplicates	
    $dsql = mysql_query("SELECT * FROM forum WHERE name='$name' ");
  		$drow = mysql_fetch_array($dsql);
   	
   	// if submission doesn't exist, add it to table
   	if($drow == false) {
			$sql = sprintf("INSERT INTO forum (name, details, sum, pic, src, everything) VALUES('$name', '$details', '$summary', '$pic', '$src', '$everything')");
			$query = mysql_query($sql);
			echo mysql_insert_id();
		}
		else {
			$sql = sprintf("UPDATE forum SET details='$details', sum='$summary', pic='$pic', src='$src', everything='$everything' WHERE name='$name' ");
			$query = mysql_query($sql);
			echo $drow['nid'];
		}
	}	
	
?>
