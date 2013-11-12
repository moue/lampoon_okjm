<?php
  require("includes/common.php");

	$uid = $_SESSION["uid"];
	if (isset($_GET['nid'])) {
    $nid = mysql_real_escape_string($_GET['nid']);
    $query = "SELECT * FROM forum WHERE nid=$nid";
  }
  else 
  		$query = "SELECT * FROM forum WHERE active=1";
  
  // Perform query
  $result = mysql_query($query);
  $row = mysql_fetch_assoc($result);
  $nid = $row['nid'];
?>

<? include 'includes/head.php' ?>

 <body>

	<? include 'includes/header.php' ?>
	<div class="container">
			<div class="alert alert-error">
				The page you are looking for does not exist!
			</div>
		
		<? include 'includes/footer.php'?>
	</div><!--end wrapper-->	
  </body>
</html>
