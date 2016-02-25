<?php
	/******************
	Pre Delete User
	******************/
	function deluser()
	{
		if(isset($_POST['username'])) {
			
			$msg = "<input type=\"hidden\" value=\"1\" name=\"DeleteUser\" />\n";
			$msg .= "Delete User  " . $_POST['username'] . "\n";
			
			$msg .= "<table>\n";
			$msg .= "<tr>\n";
			$msg .= "  <td><input type=\"submit\" name=\"deleteuser\"  id=\"deleteuser\" value=\"Delete User\" class=\"inputadmin\" </td>\n";
			$msg .= "</tr>\n";
			return $msg;
		}
	}
	
	/******************
	delete User Check
	******************/
	function delusercheck()
	{
		$msg = "<td><input type=\"submit\" name=\"admin\" value=\"Back to Admin\" class=\"inputadmin\"></td>";
		return $msg;
	}
	
	/******************
	Delete User
	******************/
	function deleteduser()
	{
		$username=$_POST['username'];
        
		//$msg = savepasswordmysql($username,$encrypt_password);
		$msg .= "Deleted.. " .  $_POST['username']  ;
		return $msg;
	}
	
	
?>