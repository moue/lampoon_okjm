<?
	ini_set("display_errors", "1");
	error_reporting(E_ALL);
?>
	<div class="navbar navbar-inverse">
		<div class="navbar-inner">
			<ul class="nav">
				<li><a href="index.php">#reasonswhyyouresingle</a></li>
			</ul>
			
			<? if(isset($_SESSION["uid"])){ 
			
			$uid = $_SESSION["uid"];
			// iff the user is logged in, grab username
			$asql = sprintf("SELECT * FROM users WHERE uid=$uid");
			$aquery = mysql_query($asql);
			$arow = mysql_fetch_assoc($aquery);
			?>
					<ul class="nav pull-right">
						<li><a class="brand" href="index.php">Welcome <? echo $arow['uname']; ?></a></li>
						<li><a href="db/logout.php" id="logout" style="cursor:pointer;">Log out</a></li>
					</ul>			
			<? } 
			else{ ?>
				<ul class="nav pull-right" id="navsignin">
				<li><a id="login" style="cursor:pointer;">Log In</a></li>
				<li><a id="signup" style="cursor:pointer;">Sign Up</a></li>
			</ul>
			<? } ?>
			
	  </div><!--end navbar-inner-->
	</div><!--end navbar-->
	
	<div class="modal hide fade">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3 id="modhead">Sign Up</h3>
		</div>
		<div class="modal-body">
			<form class="form-horizontal" id="modalform">
				<div class="control-group myerror">
					<label class="control-label" for="inputHandle">Username</label>
					<div class="controls">
						<input class="keydownsel" type="text" id="inputHandle" placeholder="Username" required>
					</div>
				</div>
				<div class="control-group myerror">
					<label class="control-label" for="inputPassword">Password</label>
					<div class="controls">
						<input class="keydownsel" type="password" id="inputPassword" placeholder="Password" required>
						<span id="myerrortext" class="help-inline" style="display: none">Username already exists!</span>
						<span id="myerrortext2" class="help-inline" style="display: none">Username/password doesn't match!</span>
					</div>
				</div>
			</form>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn modalclose">Close</a>
			<button id="modfoot" class="btn btn-primary">Sign Up</button>
		</div>
	</div>
		
	<div class="container">
	 	<div class="row">
    		<div class="span8"> 
    			<div class="hero-unit" style="padding: 25px; background-color: #eee;">
					<h1 style="font-family: 'Otari';">ok judge me</h1>
					<p>Share all those douchey, awkward, or just plain bizarre online dating profiles you come across on okcupid. Draw on profile pictures, comment and edit bad dating profiles, and look at the profiles others have submitted.</p>
					<!--<div class="alert">
						Sort by: <span class="label label-inverse">newest</span>
						<span class="label label-inverse">oldest</span>
						<span class="label label-inverse">lol</span>
						<span class="label label-inverse">wtf</span>
						<span class="label label-inverse">fail</span>
						<span class="label label-inverse">win</span>
					</div>end labels-->	
				</div><!--end hero unit-->
				<div class="pagination" style="margins: auto;">
					<ul>
						<li><a href="index.php">Featured</a></li>
						<?
							// grab all submitted profiles that are not featured
							$bquery = "SELECT * FROM forum WHERE active=0 ORDER BY nid DESC";
							$bresult = mysql_query($bquery);
							$i = 1;
							while ($brow = mysql_fetch_assoc($bresult)){
								echo '<li><a href="index.php?nid='.$brow['nid'].'">'.$i.'</a></li>';								
								$i++;
								// limit to newest 10 profiles
								if($i===11){
									break;
								}
							}
						?>
						<li><a href="forum.php">All</a></li>
					</ul>
				</div>
			</div><!--end span8-->
    	    		
    		<div class="span4">
				<form id="nominator">
					<fieldset style="background-color:#eee;" class="img-rounded">
						<div style="padding:10px 20px;">	
							<legend style="margin-bottom: 0px;"><h2 style="font-family: 'Otari';">nominate a profile</h2></legend>
							<div class="control-group" id="nomerror">
								<label>Nominate a bad dating profile for our collection. The quirkier the better! Only OKCupid usernames accepted at this time.</label>
								<div class="controls">
									<input style="width: 95%; height: 31px;" type="text" name="inputName" id="inputName" placeholder="Username" required>
								</div>
								<span id="nomerrortext" class="help-inline" style="display: none; margin-bottom: 5px;">User profile not found. Make sure your nomination's profile is publically viewable.</span>
								<button id="submit" type="submit" class="btn btn-primary">Submit</button>
							</div>
						</div>
					</fieldset>
				</form>
				
    		</div><!--end span4-->
		</div><!--end row-->   
	</div><!--end container-->
