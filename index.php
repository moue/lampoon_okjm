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
  if(!$result)
		header('Location: 404.php');  
  $row = mysql_fetch_assoc($result);
  if($row==0)
  		header('Location: 404.php');  
  $nid = $row['nid'];
?>

<? include 'includes/head.php'; ?>

  <body>
		<?include 'includes/header.php'; ?>
    <div class="container">	
		 <div class="row">
			<div class="span3">
				<label style="color: white;">Edit this picture as you'd like, then share your drawing!</label>
				<div id="editor" style="background-image: url(<? echo $row['src']; ?>); background-size: 100%; width: 100%;">
					<form action="db/save.php" method="post">
						<input type="hidden" name="data" />
						<input type="hidden" name="n_id" value="<? echo $nid ?>" />
						<div style="height: 10px;"></div>
						<input id="savelines" type="submit" class="btn" value="Save" />
						<button id="editor_clear" class="disabled btn btn-success">Clear</button>
					</form>
				</div><!--end editor-->
			
				<!--retrieve strokes from php and print each as an input value-->
				<div id="phpstrokes" style="margin-top: 100px;" class="custom_scrollbar">
				<? // grab current profile id
				$sql_sketch = "SELECT * FROM drawing WHERE nid=$nid"; 
				$query_sketch = mysql_query($sql_sketch);
		
				$i = 0;
				while($row_sk = mysql_fetch_assoc($query_sketch)) { 
					echo '<div style="background-image: url('.$row['src'].'); background-size: 100%; width: 100%;"><div class="viewer" id="viewer'.$i.'"></div></div>';
					echo '<input type="hidden" class="allstrokes" id=strokes_'.$i.' value='.$row_sk["strokes"].'>';
					echo '<div style="height: 10px;"></div>';
					$i++;
				} ?>		
				</div><!--end custom scrollbar-->
				
				<? if(isset($_SESSION["uid"])){ 
						// iff the user is logged in, grab username
						$gsql = sprintf("SELECT * FROM users WHERE uid=$uid");
						$gquery = mysql_query($gsql);
						$grow = mysql_fetch_assoc($gquery);		
						$gname = $grow['uname'];	
					}	
					else 
						$gname = "";
				?>
			
			  <!-- add a comment form -->
	      <form style="margin-top: 20px;" class="addcomment" name="addcomment">
		      <input type="hidden" value="<? echo $uid; ?>" class="uid"/>
		      <input type="hidden" value="<? echo $gname; ?>" class="uname" />
		      <input type="hidden" value="<? echo $row['nid']; ?>" class="nid" />
		      <textarea name="comment" class="comment" rows="3" style="width:255px;" placeholder="Add a comment" required></textarea>
		      <input class="btn" type="submit" value="Add Comment"/>
	      </form>
				<div class="new_comment" style="margin-top: 20px;">
				<?	 //grab every comment associated with nid
					$kquery = "SELECT comments.comment, users.uid, users.uname FROM comments, users WHERE users.uid=comments.uid AND nid=$nid";
					$kresult = mysql_query($kquery);
					while($krow = mysql_fetch_assoc($kresult)) { 
				?>
				<div class="media" style="background-color: #143778; color: white;">
					<img class="media-object pull-left" src="img/defaultpic.jpg" width=50 height=50>
					<div class="media-body">
						<h4 class="media-heading"><? echo $krow['uname'];?></h4>
						<p><? echo $krow['comment']; ?></p>
					</div>
				</div>
				<? } ?>
				</div>
			</div><!--end span3-->

			<div class="span9">
				<div style="background-color: #d3d3d3; padding: 20px;">	
					<img class="pull-right img-circle img-polaroid" src="<? echo $row['src'];?>" width=120px height=120px><h2><?echo $row['name'];?> <small><? echo $row['details']; ?></small></h2>
				</div>
				<section style="background-color: #eee; padding: 20px;">
					<div class="btn-group">
						<a class="btn btn-warning dropdown-toggle" data-toggle="dropdown" href="#">
						All versions  <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a href="index.php?nid=<? echo $nid; ?>">Original</a></li>
						<?
							$i=0;
							$rsql = "SELECT * FROM okcupid WHERE nid=$nid";
							$rquery = mysql_query($rsql);
							while($rrow = mysql_fetch_assoc($rquery)){
								echo '<li><a href="index.php?nid='.$nid.'&uname='.$rrow['uname'].'">'.$rrow['uname'].'</a></li>';
								$i++;
								if($i===11)
									break;
							}
						?>
						</ul>
					</div><!--end btn group-->
					
					<? if(isset($_GET['nid']) && isset($_GET['uname'])) {
							$uname = mysql_real_escape_string($_GET['uname']);
							$vsql = "SELECT * FROM okcupid WHERE nid=$nid AND uname='$uname'";
							$vquery = mysql_query($vsql);
							$vrow = mysql_fetch_assoc($vquery);		
							echo '<div id="content">'.stripslashes(base64_decode($vrow['sum'])).'</div>'; 
					} else { ?>
							<button class="btn btn-success editbtn">Edit</button>
							<button style="display: none;" class="btn btn-success savebtn">Save</button>
							<button style="display: none;" class="btn btn-inverse cancelbtn">Cancel</button>
						<? 
							echo '<div id="content">'.base64_decode($row['everything']).'</div>'; 
						} ?>
				</section>
			</div><!--end span9-->
   	</div><!--end row-->
    	
	<? include 'includes/footer.php'; ?>
	
	<script>
		$('.editbtn').click(function(){
			//var edits = $('#main_column').jqte().val();
			//var nid = 	$(':input[name=n_id]').val();
			var uid = $('.uid').val();
			var uname = $('.uname').val();
			if(jQuery.isEmptyObject(uid) || jQuery.isEmptyObject(uname)) {
				alert('You must be logged in to edit profiles!')
				return false;
			}
			else {
				$('#main_column').jqte();
				$('.editbtn').toggle();
				$('.cancelbtn').toggle();
				$('.savebtn').toggle();
			}
		});
		$('.cancelbtn').click(function(){
			$('.editbtn').toggle();
			$('.cancelbtn').toggle();
			$('.savebtn').toggle();
			$('#content').load(location.href +" "+"#content");
		});		
		$('.savebtn').click(function(){
			var edits = $('#main_column').jqte().val();
			var nid = 	$(':input[name=n_id]').val();
			var uid = $('.uid').val();
			var uname = $('.uname').val();
			if(jQuery.isEmptyObject(uid) || jQuery.isEmptyObject(uname)) {
				alert('You must be logged in to save your edits!')
				return false;
			}
			else {
				$.ajax({
					url: 'db/savetxt.php',
					type: "POST",
					data: {nid:nid, uname:uname, edits:edits},
					dataType: 'text',
					success: function(data){
							console.log('index line 116 success');
							window.location.href="index.php?nid="+nid+"&uname="+uname+"";
						}
				});
				return false;
			}
		});
	</script>
</body>
</html>
