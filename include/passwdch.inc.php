<?php
if(isset($_SESSION['login_user']))
{

	/******************
	Password setup
	******************/
	function passwordchange()
	{
		if(isset($_POST['username'])) {
			
			$msg = "<input type=\"hidden\" value=\"1\" name=\"passwordchangesave\" />\n";
			$msg .= "Password Change for  " . $_POST['username'] . "\n";
			$msg .= "<input type=\"hidden\" value=" . $_POST['username'] ." name=\"username\" />";
			$msg .= "<br \n>";
			$msg .= "<input name=\"password1\" type=\"password\" onkeyup=\"CheckPasswordStrength(this.value)\" / >\n";
			$msg .= "<span id=\"password_strength\"></span>";
			$msg .= "<br>Paaword agian \n";
			$msg .= "<br>\n";
			$msg .= "<input name=\"password2\" type=\"password\" onkeyup=\"validate()\" />\n";
			$msg .= "<div id=\"nameValidation\" class=\"validation-image\"></div>\n";
			$msg .= "<br>\n";
			
			$msg .= "</table>\n";
			$msg .= "<table>\n";
			$msg .= "<tr>\n";
			$msg .= "  <td><input type=\"submit\" name=\"savepasswd\"  id=\"savepasswd\" value=\"Save Password\" class=\"inputadminfalse\" disabled></td>\n";
			$msg .= "</tr>\n";
			return $msg;
		}
	}

	/******************
	Password save
	******************/
	function passwordsave()
	{
		$username=$_POST['username'];
		$password=$_POST['password1'];      
		$encrypt_password="*" . sha1(sha1($password,true));
		$msg = savepasswordmysql($username,$encrypt_password);
		$msg .= "Saved " .  $_POST['username']  ;
		return $msg;
	}
	
	/******************
	Password setup as user
	******************/
	function passwordchangeuser()
	{
		include("include/java.inc.php");
		if(isset($_POST['username'])) {
			
			$msg = "<input type=\"hidden\" value=\"1\" name=\"passwordchangesave\" />\n";
			$msg .= "Password Change for  " . $_POST['username'] . "\n";
			$msg .= "<input type=\"hidden\" value=" . $_POST['username'] ." name=\"username\" />";
			$msg .= "<br \n>";
			$msg .= "<input name=\"password1\" type=\"password\" onkeyup=\"CheckPasswordStrength(this.value)\" / >\n";
			$msg .= "<span id=\"password_strength\"></span>";
			$msg .= "<br>Paaword again \n";
			$msg .= "<br>\n";
			$msg .= "<input name=\"password2\" type=\"password\" onkeyup=\"validate()\" />\n";
			$msg .= "<div id=\"nameValidation\" class=\"validation-image\"></div>\n";
			$msg .= "<br>\n";
			
			$msg .= "</table>\n";
			$msg .= "<table>\n";
			$msg .= "<tr>\n";
			$msg .= "  <td><input type=\"submit\" name=\"savepasswd\"  id=\"savepasswd\" value=\"Save Password\" class=\"inputadminfalse\" disabled></td>\n";
			$msg .= "</tr>\n";
			$msg .= "<tr>";
			$msg .= "<td ><input type=\"submit\" name=\"goback\" value=\"Go Back Main\" class=\"inputadmin\"></td> ";
			$msg .= "</tr>";
			return $msg;
		}
	}
}
?>