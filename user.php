<?php

	function showuser_change_rows($rows)
	{
		$msg = "<select name=\"users\" onchange=\"showUserChange(this.value)\">";
		$msg .= "<option value=\"\">Select a person:</option>";
		foreach($rows as $access_row) : 
			$msg .=  "<option value=\"" . $access_row['id'] . "\">" . $access_row['username'] . "</option>";
		endforeach;
		$msg  .=  "	</select>";
		$msg .="<div id=\"txtHint\"><b>Person info will be listed here...</b></div>";
		return $msg;
	}
	
function user_row_f($access_row)
	{
		$msg =  "<table>\n";
		$msg .=  "<tr>\n";
		$msg .= "<th>User Name</th>\n";
		$msg .= "<th>Name</th>\n";
		$msg .= "<th>Email</th>\n";
		$msg  .=  "	</tr>\n";
				
		$msg .=  "<tr>\n";
		$msg .= "<td>" . $access_row['username'] ."</td>\n";
		$msg .= "<td>" . $access_row['Name'] ."</td>\n";
		$msg .= "<td>" . $access_row['Email'] ."</td>\n";
		$msg .= "<input type=\"hidden\" value=" . $access_row['username'] ." name=\"username\" />\n";
		$msg  .=  "	</tr>\n";
		
		$msg  .=  "	</table>\n";
		$msg  .= "<table>\n";
		$msg  .= "<tr>\n";
		$msg  .= "  <td><input type=\"submit\" name=\"changepassword\" value=\"Change Password\" class=\"inputadmin\"></td>\n";
		$msg  .= "</tr>\n";
		$msg  .= "<tr>\n";
		$msg  .= "  <td><input type=\"submit\" name=\"deluser\" value=\"Delete User\" class=\"inputadmin\"></td>\n";
		$msg  .= "</tr>\n";
		$msg  .= "<tr>\n";
		$msg  .=  "<td><input type=\"submit\" name=\"edituser\" value=\"Edit Info\" class=\"inputadmin\"></td>\n";
		$msg  .= "</tr>\n";
		return $msg;
	}
	
?>