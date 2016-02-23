<?php
function passwordchange()
{
	if(isset($_POST['username'])) {
		
		$msg = "<input type=\"hidden\" value=\"1\" name=\"passwordchangesave\" />\n";
		$msg .= "Password Change for  " . $_POST['username'] . "\n";
		
		$msg .= "<br \n>";
		$msg .= "<input name=\"password1\" type=\"password\" onblur=\"validate()\" / >\n";
		$msg .= "<br>Paaword agian \n";
		$msg .= "<br>\n";
		$msg .= "<input name=\"password2\" type=\"password\" onblur=\"validate()\" />\n";
		$msg .= "<div id=\"nameValidation\" class=\"validation-image\"></div>\n";
		$msg .= "<br>\n";
		
		$msg .= "</table>\n";
		$msg .= "<table>\n";
		$msg .= "<tr>\n";
		$msg .= "  <td><input type=\"submit\" name=\"savepasswd\"  id=\"savepasswd\" value=\"Save Access\" class=\"inputadmin\"></td>\n";
		$msg .= "</tr>\n";
		return $msg;
    }
	
}

?>