<?php

        require("../includes/common.php");

        // Save the cleaned input data
        $uid = mysql_real_escape_string($_POST['uid']);
        $comment = mysql_real_escape_string($_POST['comment']);
        $nid = mysql_real_escape_string($_POST['nid']);
				
				$esql = "SELECT * FROM users WHERE uid = $uid";
				$eresource = mysql_query($esql);
				$erow = mysql_fetch_array($eresource);
				$uname = $erow['uname'];

        // Make sure data is reasonable length
        if(strlen($comment) > 512)
        {
                die("Comment too long");
        }

        // Add comment into comment list
        $query = "INSERT INTO comments (nid, uid, comment) VALUES('$nid', '$uid', '$comment')";
        mysql_query($query);
        
        $items = array('uname'=>$uname, 'nid'=>$nid, 'comment'=>$comment);
        echo json_encode(array($items));
?>
