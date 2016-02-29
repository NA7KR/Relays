<?php
if(isset($_SESSION['login_user']))
{
	function edituser()
	{
		$username = $_POST['username'];
		return showuserinfoedit($username);
	}

	function edituserrow($access_row)
	{
		$msg = "<h2> Edit User " . $access_row['username'] . "</h2>";
		$msg = "<input type=\"hidden\" value=\"" . $access_row['id'] . "\" name=\"id\" />\n";
		$msg .= "<table>\n";
		$msg .= "<tr>\n";
		$msg .= "<td>Username</td>\n";
		$msg .= "<td><input name=\"username\" type=\"text\" value=\"" . $access_row['username'] . "\"></td>\n";
		$msg .= "</tr>\n";
		
		$msg .= "<tr>\n";
		$msg .= "<td>Name</td>\n";
		$msg .= "<td><input name=\"name\" type=\"text\" value=\"" . $access_row['Name'] . "\"></td>\n";
		$msg .= "</tr>\n";
		
		$msg .= "<tr>\n";
		$msg .= "<td>Email</td>\n";
		$msg .= "<td><input  name=\"email\" type=\"text\"/ value=\"" . $access_row['Email'] . "\"></td>\n";
		$msg .= "</tr>\n";
		
		$msg .= "<tr>\n";
		$msg .= "<td colspan=\"2\">Change Password is done on Password Screen</td>\n";
		$msg .= "</tr>\n";
		
		$msg .= "<tr>\n";
		$msg .= "<td><input type=\"submit\" name=\"editusersave\" value=\"Save\" class=\"inputadmin\"></td>\n";
		$msg .= "</tr>\n";
		
		return $msg;
	}
	function editusersave()
	{
		 editusersaved($_POST['id'],$_POST['username'],$_POST['name'],$_POST['email']);
	}
}
?>