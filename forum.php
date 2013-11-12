<?php
  require("includes/common.php");
  // grab posts from submissions
  $gquery = "SELECT * FROM forum ORDER BY nid DESC";
    
  // perform query
  $gresult = mysql_query($gquery);
  
  // check if admin
  $query1 = "SELECT * FROM users WHERE admin=1";
  $result1 = mysql_query($query1);
  $row1 = mysql_fetch_assoc($result1);
  
  $uid = $_SESSION["uid"];
?>

<? include 'includes/head.php'; ?>


  <body>

	<?include 'includes/header.php'; ?>
	
	<div class="container">
		<? $j = 0; 
		while($grow = mysql_fetch_array($gresult)) {?>
			<div class="row" style="margin-bottom: 20px;">
				<aside class="span2">
					<? echo $grow['pic'];
						//check if logged in user is admin
						if(isset($_SESSION["uid"])){ 
							$uid = $_SESSION["uid"];
							if($uid===$row1['uid']){
								echo '<form style="padding: 10px;" action="db/activate.php" method="get"><input type="hidden" name="nid" value="'.$grow['nid'].'"><button type="submit" class="btn btn-inverse">Feature Profile</button></form>';
							}
						}	
					?>
				</aside><!--end span3-->
					
				<article class="span10" style="background-color: #eee;">
					<div style="padding: 0px 20px 20px 20px;" id="<? echo $grow['name']; ?>">
						<div style="clear: both">
							<a href="#<? echo $grow['name']; ?>"><h4 style="padding-right: 20px;" class="pull-left media-heading"><? echo $grow['name']; ?></h4></a>
						</div>
						<h5 style="padding=top: 1px;"><? echo $grow['details']; ?></h5>
						<!--<span class="badge badge-inverse"><? echo $row['votes'];?></span>
						<span class="label label-inverse vote" id="<? echo $row['nid'];?>">lol</span>
						<span class="badge badge-inverse"><? echo $row['votes'];?></span>
						<span class="label label-inverse vote" id="<? echo $row['nid'];?>">wtf</span>
						<span class="badge badge-inverse"><? echo $row['votes'];?></span>
						<span class="label label-inverse vote" id="<? echo $row['nid'];?>">fail</span>
						<span class="badge badge-inverse"><? echo $row['votes'];?></span>
						<span class="label label-inverse vote" id="<? echo $row['nid'];?>">win</span>-->
						<hr>
						<? echo base64_decode($grow['sum']); ?>
						<a href="index.php?nid=<? echo $grow['nid']; ?>"><h5>View Full Profile</h5></a>
					</div><!--end fix padding-->
			 	</article><!--end span9-->
			</div><!--end row-->
			 <? } ?>
		 

	</div><!--end container-->
	

	
	<? include 'includes/footer.php'; ?>

	</body>
</html>
