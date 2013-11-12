<?php
  
  require("includes/common.php");
	
	function clean($string) {
	   $string = str_replace(" ", "-", $string); // Replaces all spaces with hyphens.
	   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

	   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
	}
	
	$input = 'asdfasdfasdf';
	  	
	exec("/home/groups/podcast/bin/python nominate.py $input", $output);

	print_r($output[0]);
	
	if($output[0] == 'error')
		print_r($output[0]);
		
	else {	
		$result = json_decode($output[0], true);	
	
		$pic = $result['pic'];
		$details = $result['details'];
		$summary = base64_encode($result['summary']);
	
		$sql = sprintf("INSERT INTO okcupid (details, sum, pic_html) VALUES('$details', '$summary', '$pic')");
		$query = mysql_query($sql);
	}	
	
?>
