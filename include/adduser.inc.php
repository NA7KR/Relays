<?php
if(isset($_SESSION['login_user']))
{
	function adduser()
	{
		$msg = "<h2> Add User</h2>";
		$msg .= "<table>\n";
		
		$msg .= "<tr>\n";
		$msg .= "<td>Username</td>\n";
		$msg .= "<td><input name=\"username\"type=\"text\"></td>\n";
		$msg .= "</tr>\n";
		
		$msg .= "<tr>\n";
		$msg .= "<td>Name</td>\n";
		$msg .= "<td><input name=\"name\" type=\"text\"></td>\n";
		$msg .= "</tr>\n";
		
		$msg .= "<tr>\n";
		$msg .= "<td>Email</td>\n";
		$msg .= "<td><input  name=\"email\" type=\"text\"/></td>\n";
		$msg .= "</tr>\n";
		
		$msg .= "<tr>\n";
		$msg .= "<td>Password</td>\n";
		$msg .= "<td><input name=\"password\" type=\"password\"></td>\n";
		$msg .= "</tr>\n";
		
		$msg .= "<tr>\n";
		$msg .= "  <td><input type=\"submit\" name=\"adduserpost\" value=\"Add New User\" class=\"inputadmin\"></td>\n";
		$msg .= "</tr>\n";
		return $msg;
	}

	function adduserpost()
	{
		$msg ="";
			if (empty($_POST["username"])) 
			{
				$nameErr = "User Name is required";
			} 
			else 
			{
				$username = ($_POST["username"]);
				// check if name only contains letters and numbers
				if (!preg_match("/^[a-zA-Z1-9]*$/",$username)) 
				{
					$msg = "Only letters and numbers allowed"; 
				}
			}

			if (empty($_POST["name"])) 
			{
				$nameErr = "Name is required";
			} 
			else 
			{
				$name = ($_POST["name"]);
				// check if name only contains space and numbers
				if (!preg_match("/^[a-zA-Z ]*$/",$name)) 
				{
					$msg = "Only letters and space allowed in User Name\n";
					$msg .= "<br>\n";
				}
			}
			
			if (empty($_POST["email"])) 
			{
				$msg = "Email is required";
			} 
			else 
			{
				$email = ($_POST["email"]);
				// check if e-mail address is well-formed
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
				{
					$msg = "Invalid email format"; 
				}
			}
			
			if (empty($_POST["password"])) 
			{
				$nameErr = "Password required";
			} 
			else
			{
				$password = ($_POST["password"]);
			}
			if ($msg == "")
			{
				 insertadduser($username,$name,$email,$password);
			}
			else
			{
				$msg .= "  <td><input type=\"submit\" name=\"adduser\" value=\"Add User\" class=\"inputadmin\"></td>";
			}
		return $msg;
	}
}
?>