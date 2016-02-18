<?php
	function access_row($rows)
	{
		$msg  = showusers();	
		$msg .=  "<table>";
		$msg .=  "<tr>";
		$msg .= "<td>User Name</td>";
		$msg .= "<td>Relay 1</td>";
		$msg .= "<td>Relay 2</td>";
		$msg .= "<td>Relay 3</td>";
		$msg .= "<td>Relay 4</td>";
		$msg .= "<td>Relay 5</td>";
		$msg .= "<td>Relay 6</td>";
		$msg .= "<td>Relay 7</td>";
		$msg .= "<td>Relay 8</td>";
		$msg .= "<td>Relay All</td>";
		$msg .= "<td>Admin</td>";
		$msg  .=  "	</tr>";
				
		foreach($rows as $access_row) : 
			$msg .=  "<tr>";
			$msg .= "<td><input type=\"text\" name=\"username\" value=\"" . $access_row['username'] . "\"   ></td>\n";
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
		endforeach;
		$msg  .=  "	</table>";
		return $msg;
	}
	
	/******************
	Save Access
	******************/
	function savepostaccess()
	{
		$msg = updateaccess(
							$_POST["username"],
							$_POST["relay1"],
							$_POST["relay2"],
							$_POST["relay3"],
							$_POST["relay4"],
							$_POST["relay5"],
							$_POST["relay6"],
							$_POST["relay7"],
							$_POST["relay8"],
							$_POST["relayall"],
							$_POST["admin"]);
		return  $msg;
	}
?>