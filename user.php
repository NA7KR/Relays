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
		$msg =  "<table>";
		$msg .=  "<tr>";
		$msg .= "<th>User Name</th>";
		$msg  .=  "	</tr>";
				
		
		$msg .=  "<tr>";
		$msg .= "<td>" . $access_row['username'] ."</td>\n";
		$msg .= "<input type=\"hidden\" value=" . $access_row['username'] ." name=\"username\" />";
		$msg  .=  "	</tr>";
		
		$msg  .=  "	</table>";
		return $msg;
	}
	
?>