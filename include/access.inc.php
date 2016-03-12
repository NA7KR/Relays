<?php

if(isset($_SESSION['login_user']))
{
	require_once("include/sqli.inc.php");			


	/******************
	Access Row info
	******************/
	function access_row_f($access_row)
	{
		$name_row = querysql("SELECT `Relay 1`,`Relay 2`,`Relay 3`,`Relay 4`,`Relay 5`,`Relay 6`,`Relay 7`,`Relay 8` FROM `Names`");
		$msg =  "<table border=\"1\">\n";
		$msg .=  "<tr>\n";
		$msg .= "<th width=\"100\">User Name</th>\n";
		$msg .= "<th width=\"100\">" . $name_row['Relay 1'] . "</th>\n";
		$msg .= "<th width=\"100\">" . $name_row['Relay 2'] . "</th>\n";
		$msg .= "<th width=\"100\">" . $name_row['Relay 3'] . "</th>\n";
		$msg .= "<th width=\"100\">" . $name_row['Relay 4'] . "</th>\n";
		$msg .= "<th width=\"100\">" . $name_row['Relay 5'] . "</th>\n";
		$msg .= "<th width=\"100\">" . $name_row['Relay 6'] . "</th>\n";
		$msg .= "<th width=\"100\">" . $name_row['Relay 7'] . "</th>\n";
		$msg .= "<th width=\"100\">" . $name_row['Relay 8'] . "</th>\n";
		$msg .= "<th width=\"100\">Relay All</th>\n";
		$msg .= "<th width=\"100\">Admin</th>\n";
		$msg  .=  "	</tr>\n";
				
		$msg .=  "<tr>\n";
		$msg .= "<td>" . $access_row['username'] ."</td>\n";
		$msg .= "<input type=\"hidden\" value=" . $access_row['username'] ." name=\"username\" />";
		$msg .= "<td><input type=\"CHECKBOX\" name=\"relay1\" " .  checked($access_row['Relay 1']) . " class=\"relay\" ></td>\n";
		$msg .= "<td><input type=\"CHECKBOX\" name=\"relay2\" " .  checked($access_row['Relay 2']) . " class=\"relay\"  ></td>\n";
		$msg .= "<td><input type=\"CHECKBOX\" name=\"relay3\" " .  checked($access_row['Relay 3']) . " class=\"relay\" ></td>\n";
		$msg .= "<td><input type=\"CHECKBOX\" name=\"relay4\" " .  checked($access_row['Relay 4']) . " class=\"relay\" ></td>\n";
		$msg .= "<td><input type=\"CHECKBOX\" name=\"relay5\" " .  checked($access_row['Relay 5']) . " class=\"relay\" ></td>\n";
		$msg .= "<td><input type=\"CHECKBOX\" name=\"relay6\" " .  checked($access_row['Relay 6']) . " class=\"relay\" ></td>\n";
		$msg .= "<td><input type=\"CHECKBOX\" name=\"relay7\" " .  checked($access_row['Relay 7']) . " class=\"relay\" ></td>\n";
		$msg .= "<td><input type=\"CHECKBOX\" name=\"relay8\" "  . checked($access_row['Relay 8']) . " class=\"relay\" ></td>\n";
		$msg .= "<td><input type=\"CHECKBOX\" name=\"relayall\" "  . checked($access_row['Relay All']) . " class=\"relay\" ></td>\n";
		$msg .= "<td><input type=\"CHECKBOX\" name=\"admin\" " . checked($access_row['Admin']) . " class=\"relay\"  ></td>\n";
		$msg  .=  "	</tr>";
		
		$msg  .=  "	</table>\n";
		$msg .= "<table>\n";
		$msg .= "<tr>\n";
		$msg .= "  <td><input type=\"submit\" name=\"savepostaccess\" value=\"Save Access\" class=\"inputadmin\"></td>\n";
		$msg .= "</tr>\n";
		return $msg;
	}
	
	/******************
	Save Access
	******************/
	function savepostaccess()
	{
		$msg = updateaccess(
							$_POST["username"],
							onoff("relay1"),
							onoff("relay2"),
							onoff("relay3"),
							onoff("relay4"),
							onoff("relay5"),
							onoff("relay6"),
							onoff("relay7"),
							onoff("relay8"),
							onoff("relayall"),
							onoff("admin"));
		return  $msg;
	}
	
	/******************
	On Off on =1 and stop Notice: Undefined index
	******************/
	function onoff($state)
	{
		if(isset($_POST[$state]))
		{
			if($_POST[$state] != null)
				return "1";
			else
				return "0";
		}
		else
			return "0";
	}
	
	/********************
	Show Usrs with Access
	********************/
	function showuser_access_rows($rows)
	{
		$msg = "<select name=\"users\" onchange=\"showUserAccess(this.value)\">";
		$msg .= "<option value=\"\">Select a person:</option>";
		foreach($rows as $access_row) : 
			$msg .=  "<option value=\"" . $access_row['id'] . "\">" . $access_row['username'] . "</option>";
		endforeach;
		$msg  .=  "	</select>";
		$msg .="<div id=\"txtHint\"><b>Person info will be listed here...</b></div>";
		return $msg;
	}
}	
else
{
	echo "no session";
}
?>