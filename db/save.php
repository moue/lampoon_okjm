<?php
        require("../includes/common.php");
        
        $nid = mysql_real_escape_string($_POST['n_id']);
        $strokes = mysql_real_escape_string($_POST['data']);
        
        $sql = sprintf("INSERT INTO drawing(nid, strokes) VALUES('$nid', '$strokes')");
				$query = mysql_query($sql);
				
		   header( "Location: ../index.php?nid=$nid" ) ;

?>
