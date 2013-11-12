<?php
        require("../includes/common.php");

        $uname = mysql_real_escape_string($_POST['handle']);
        $pwd = mysql_real_escape_string($_POST['pwd']);
				$pw = crypt($pwd);
				// check for duplicates	
				$dsql = mysql_query("SELECT * FROM users WHERE uname='$uname' ");
			 	$drow = mysql_fetch_array($dsql);
			 	
			 	// if user doesn't exist, add it to table
			 	if($drow == 0) {
					$fsql = sprintf("INSERT INTO users(uname, pwd) VALUES('$uname', '$pw')");
					$fresource = mysql_query($fsql);
	        $_SESSION["uid"] = mysql_insert_id();
	        echo $_SESSION["uid"];
				}
				else {
					echo 1;
				}

?>

