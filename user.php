<?php
	function showuser_rows($rows)
	{
		Global $q;
		$msg = "<select name=\"users\" onchange=\"showUser(this.value)\">";
		$msg .= "<option value=\"\">Select a person:</option>";
		foreach($rows as $access_row) : 
			$msg .=  "<option value=\"" . $access_row['id'] . "\">" . $access_row['username'] . "</option>";
		endforeach;
		$msg  .=  "	</select>";
		$msg .="<div id=\"txtHint\"><b>Person info will be listed here...</b></div>";
		echo $GLOBALS['id'];
		return $msg;
	}
	
	
	
?>