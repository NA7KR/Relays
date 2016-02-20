<?php
function passwordchange()
{
	if(isset($_POST['username'])) {
		
		$msg = "<input type=\"hidden\" value=\"1\" name=\"passwordchangesave\" />\n";
		$msg .= "Password Change!!!! " . $_POST['username'];
		$msg  .=  "	</table>\n";
		$msg .= "<table>\n";
		$msg .= "<tr>\n";
		$msg .= "  <td><input type=\"submit\" name=\"savepasswd\" value=\"Save Access\" class=\"inputadmin\"></td>\n";
		$msg .= "</tr>\n";
		return $msg;
    }
	
}

?>