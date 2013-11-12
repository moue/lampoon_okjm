
<?php
       	//define database constants
				define("DB_USER","podcast");
				define("DB_PASS","G5FJYPXUiVoe");
				define("DB_HOST","mysql.hcs.harvard.edu");
				define("DB_NAME","podcast");

				//create a DB connection
				$link = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die('Could not connect to mysql server.');
				mysql_select_db(DB_NAME);

        $uname = mysql_real_escape_string($_POST['handle']);
        $pwd = mysql_real_escape_string($_POST['pwd']);

				// check for match
				$dsql = mysql_query("SELECT * FROM users WHERE uname='$uname' ");
			 	$drow = mysql_fetch_array($dsql);
				
			 	// if user doesn't exist, return error
			 	if($drow == 0){
					echo 1;
				}
				else {
					// compare hash of user's input against hash that's in database
        	if (crypt($pwd, $drow["pwd"]) == $drow["pwd"]){
            // remember that user's now logged in by caching user's ID in session
          	session_start();
          	$_SESSION["uid"] = $drow["uid"];
						// send username back to ajax
						echo $_SESSION["uid"];
					}
					else 
						echo 2;
		      }
?>
