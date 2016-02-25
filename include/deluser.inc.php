<?php
	/******************
	Pre Delete User
	******************/
	function deluser()
	{
		if(isset($_POST['username'])) {
			
			$msg = "<input type=\"hidden\" value=\"1\" name=\"DeleteUser\" />\n";
			$msg .= "Delete User  " . $_POST['username'] . "\n";
			$msg = "<input type=\"hidden\" value=\"" . $_POST['username'] . "\" name=\"username\" />\n";
			$msg .= "<table>\n";
			$msg .= "<tr>\n";
			$msg .= "  <td><input type=\"submit\" name=\"deleteuser\"  id=\"deleteuser\" value=\"Delete User " . $_POST['username'] . "\" class=\"inputadmin\" </td>\n";
			$msg .= "</tr>\n";
			$msg .= "<tr>\n";
			$msg .= "<td><input type=\"submit\" name=\"admin\" value=\"Back to Admin\" class=\"inputadmin\"></td>";
			$msg .= "</tr>\n";
			return $msg;
		}
	}
	

	
	/******************
	Delete User
	******************/
	function deleteduser()
	{
		$username=$_POST['username'];
        
		$msg = deleteusermysql($username);
		$msg .= "Deleted.. " .  $_POST['username']  ;
		return $msg;
	}
	
	
?>