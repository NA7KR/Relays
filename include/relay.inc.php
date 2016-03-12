<?php
if(isset($_SESSION['login_user']))
{
	
	/******************
	Save Names
	******************/
	function savepostrelaynames()
	{
		$msg = updatenames(	$_POST["relay1"],
							$_POST["relay2"],
							$_POST["relay3"],
							$_POST["relay4"],
							$_POST["relay5"],
							$_POST["relay6"],
							$_POST["relay7"],
							$_POST["relay8"]);
		
		return  $msg;
	}
	
	/******************
	Show Names
	******************/
	function showrelaynames()
	{
		$name_row = querysql("SELECT `Relay 1`,`Relay 2`,`Relay 3`,`Relay 4`,`Relay 5`,`Relay 6`,`Relay 7`,`Relay 8` FROM `Names`");
		
		$msg = "<table>";
		$msg  .=  "	<tr>";
		$msg  .=  "		<td>Realy 1</td>";
		$msg  .=  "<td><input type=\"text\" name=\"relay1\" value=\"" . $name_row['Relay 1'] . "\" ></td>\n";	
		$msg  .=  "	</tr>";
		$msg  .=  "	<tr>";
		$msg  .=  "		<td>Realy 2</td>";
		$msg  .=  "<td><input type=\"text\" name=\"relay2\" value=\"" . $name_row['Relay 2'] . "\" ></td>\n";		
		$msg  .=  "	</tr>";
		$msg  .=  "	<tr>";
		$msg  .=  "		<td>Realy 3</td>";
		$msg  .=  "<td><input type=\"text\" name=\"relay3\" value=\"" . $name_row['Relay 3'] . "\" ></td>\n";	
		$msg  .=  "	</tr>";
		$msg  .=  "	<tr>";
		$msg  .=  "		<td>Realy 4</td>";
		$msg  .=  "<td><input type=\"text\" name=\"relay4\" value=\"" . $name_row['Relay 4'] . "\" ></td>\n";		
		$msg  .=  "	</tr>";
		$msg  .=  "	<tr>";
		$msg  .=  "		<td>Realy 5</td>";
		$msg  .=  "<td><input type=\"text\" name=\"relay5\" value=\"" . $name_row['Relay 5'] . "\" ></td>\n";		
		$msg  .=  "	</tr>";
		$msg  .=  "	<tr>";
		$msg  .=  "		<td>Realy 6</td>";
		$msg  .=  "<td><input type=\"text\" name=\"relay6\" value=\"" . $name_row['Relay 6'] . "\" ></td>\n";	
		$msg  .=  "	</tr>";
		$msg  .=  "	<tr>";
		$msg  .=  "		<td>Realy 7</td>";
		$msg  .=  "<td><input type=\"text\" name=\"relay7\" value=\"" . $name_row['Relay 7'] . "\" ></td>\n";	
		$msg  .=  "	</tr>";
		$msg  .=  "	<tr>";
		$msg  .=  "		<td>Realy 8</td>";
		$msg  .=  "<td><input type=\"text\" name=\"relay8\" value=\"" . $name_row['Relay 8'] . "\" ></td>\n";	
		$msg  .=  "	</tr>";
		$msg  .=  "	</table>";
		return  $msg;
	}	
}
?>