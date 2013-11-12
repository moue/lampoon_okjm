<?php
        require("../includes/common.php");
        $nid = mysql_real_escape_string($_POST['nid']);
        $uname = mysql_real_escape_string($_POST['uname']);
        $edits = mysql_real_escape_string($_POST['edits']);
        $sum = base64_encode($edits);
        
        // check for duplicates	
				$ssql = mysql_query("SELECT * FROM okcupid WHERE uname='$uname' AND nid='$nid'");
			 	echo $ssql;
			 	// if user doesn't exist, add it to table
			 	if(mysql_num_rows($ssql)===0) {
		      $sql = sprintf("INSERT INTO okcupid(uname, nid, sum) VALUES('$uname', '$nid', '$sum')");
		     }
		    else {
		    $sql = sprintf("UPDATE okcupid SET sum='$sum' WHERE uname='$uname' AND nid='$nid'");
		    }
		    echo $sql;
		    $query = mysql_query($sql);
?>
