<?php
	$showusers_active =false;
	$shownaccess_active = false;
	$shownames_active = false;
	include('session.php');
	if(isset($_POST['goback'])) {
        header("Location: profile.php"); // Redirecting To main
    }
	if(isset($_POST['showusers'])) {
		$showusers_active =true;
		$msg = showusers();
    }
    if(isset($_POST['shownaccess'])) {
		$shownaccess_active = true;
		$msg = shownaccess();
    }
    if(isset($_POST['shownames'])) {
		$shownames_active = true;
		$msg = shownames();
    }
	if(isset($_POST['save'])) {
		$shownames_active = true;
		$msg = save();
    }
	
	function save()
	{
		$msg = updatenames(	$_POST["relay1"],
							$_POST["relay2"],
							$_POST["relay3"],
							$_POST["relay4"],
							$_POST["relay5"],
							$_POST["relay6"],
							$_POST["relay7"],
							$_POST["relay8"]);
		
		$msg  .=  "Saved";
		return  $msg;
	}
	
	function shownames()
	{
		$sql = query("SELECT `Relay 1`,`Relay 2`,`Relay 3`,`Relay 4`,`Relay 5`,`Relay 6`,`Relay 7`,`Relay 8` FROM `Names`");
		$name_row = fetch_array($sql);
		
		$msg = "<table>";
		$msg  .=  "	<tr>";
		$msg  .=  "		<td>Realy 1</td>";
		$msg  .=  "<td><input type=\"text\" name=\"relay1\" value=\" " . $name_row['Relay 1'] . "\" ></td>\n";	
		$msg  .=  "	</tr>";
		$msg  .=  "	<tr>";
		$msg  .=  "		<td>Realy 2</td>";
		$msg  .=  "<td><input type=\"text\" name=\"relay2\" value=\" " . $name_row['Relay 2'] . "\" ></td>\n";		
		$msg  .=  "	</tr>";
		$msg  .=  "	<tr>";
		$msg  .=  "		<td>Realy 3</td>";
		$msg  .=  "<td><input type=\"text\" name=\"relay3\" value=\" " . $name_row['Relay 3'] . "\" ></td>\n";	
		$msg  .=  "	</tr>";
		$msg  .=  "	<tr>";
		$msg  .=  "		<td>Realy 4</td>";
		$msg  .=  "<td><input type=\"text\" name=\"relay4\" value=\" " . $name_row['Relay 4'] . "\" ></td>\n";		
		$msg  .=  "	</tr>";
		$msg  .=  "	<tr>";
		$msg  .=  "		<td>Realy 5</td>";
		$msg  .=  "<td><input type=\"text\" name=\"relay5\" value=\" " . $name_row['Relay 5'] . "\" ></td>\n";		
		$msg  .=  "	</tr>";
		$msg  .=  "	<tr>";
		$msg  .=  "		<td>Realy 6</td>";
		$msg  .=  "<td><input type=\"text\" name=\"relay6\" value=\" " . $name_row['Relay 6'] . "\" ></td>\n";	
		$msg  .=  "	</tr>";
		$msg  .=  "	<tr>";
		$msg  .=  "		<td>Realy 7</td>";
		$msg  .=  "<td><input type=\"text\" name=\"relay7\" value=\" " . $name_row['Relay 7'] . "\" ></td>\n";	
		$msg  .=  "	</tr>";
		$msg  .=  "	<tr>";
		$msg  .=  "		<td>Realy 8</td>";
		$msg  .=  "<td><input type=\"text\" name=\"relay8\" value=\" " . $name_row['Relay 8'] . "\" ></td>\n";	
		$msg  .=  "	</tr>";
		$msg  .=  "	</table>";
		return  $msg;
	}
	
	function shownaccess()
	{
		return  "shownaccess";
	}
	
	function showusers()
	{
		return  "showusers";
	}
	
	//get access
	$sql = query("SELECT `Admin` FROM `Access`, `Login` WHERE `id` = `login_id` and `username`= \"$login_session\"");
	$access_row = fetch_array($sql);
	//end access save as array $access_row
	if ($access_row['Admin']) 
	{
		
	}
	else
	{
		header("Location: profile.php"); // Redirecting To main
	}
?>
<html>
    <head>
    <title>Relay Admin</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <form action="admin.php" method="post">
            <div id="profile">
                <b id="welcome">Welcome Admin: <i><?php echo  $login_session; ?></i></b>
                <b id="logout"><a href="logout.php">Log Out</a></b>
            </div>
            <br>
			
			<?php 
				if ($showusers_active || $shownaccess_active ||$shownames_active )
				{
						echo $msg;
						echo "<table>";
						echo "<tr>";
						echo "  <td><input type=\"submit\" name=\"save\" value=\"Save\" class=\"inputadmin\"></td>";
						echo "</tr>";
						echo "<tr>";
						echo "  <td><input type=\"submit\" name=\"admin\" value=\"Back to Admin\" class=\"inputadmin\"></td>";
						echo "</tr>";
					}
					else
					{
					?>
							<table>
							<tr>
								<td><input type="submit" name="showusers" value="Show Users" class="inputadmin"></td>
							</tr>
							<tr>
								<td ><input type="submit" name="shownames" value="Show Relay Names" class="inputadmin"></td> 
							</tr>
							<tr>
								<td ><input type="submit" name="shownaccess" value="Show access" class="inputadmin"></td>
							</tr>
						
					<?php 
					
				}
			 ?>
			 	<tr>
					<td ><input type="submit" name="goback" value="Go Back Main" class="inputadmin"></td> 
				</tr>
			</table>
		</form>
	</body>
<html>