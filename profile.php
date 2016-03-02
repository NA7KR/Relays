<?php
include('include/session.inc.php');

    
	$msg = "";
	$passwordchangeusercheck=false;
	$editchangeuse_check=false;
	
    if(isset($_POST['r1-on'])) {
        sendCommand(1,1);
    }
    if(isset($_POST['r1-off'])) {
        sendCommand(1,0);
    }
    if(isset($_POST['r2-on'])) {
        sendCommand(2,1);
    }
    if(isset($_POST['r2-off'])) {
        sendCommand(2,0);
    }
    if(isset($_POST['r3-on'])) {
        sendCommand(3,1);
    }
    if(isset($_POST['r3-off'])) {
        sendCommand(3,0);
    }
    if(isset($_POST['r4-on'])) {
        sendCommand(4,1);
    }
    if(isset($_POST['r4-off'])) {
        sendCommand(4,0);
    }
    if(isset($_POST['r5-on'])) {
        sendCommand(5,1);
    }
    if(isset($_POST['r5-off'])) {
        sendCommand(5,0);
    }
    if(isset($_POST['r6-on'])) {
        sendCommand(6,1);
    }
    if(isset($_POST['r6-off'])) {
        sendCommand(6,0);
    }
   if(isset($_POST['r7-on'])) {
        sendCommand(7,1);
    }
    if(isset($_POST['r7-off'])) {
        sendCommand(7,0);
    }
    if(isset($_POST['r8-on'])) {
        sendCommand(8,1);
    }
    if(isset($_POST['r8-off'])) {
        sendCommand(8,0);
    }
    if(isset($_POST['r9-on'])) {
        sendCommand(248,136);
    }
    if(isset($_POST['r9-off'])) {
        sendCommand(248,128);
    }
	if(isset($_POST['query'])) {
        sendCommand(255,255); //FD 02 20 FF FF 5D
    }
	if(isset($_POST['admin'])) {
        header("Location: admin.php"); // Redirecting To admin
    }
	if(isset($_POST['passwordchangeuser'])) {
		
		$passwordchangeusercheck=true;	
    }
	if(isset($_POST['savepasswd'])) {
		$shownaccess_active = true;
		include("include/passwdch.inc.php");
		$msg = passwordsave();
    }
	
	if(isset($_POST['editchangeuser'])) {
		$shownaccess_active = true;
		$editchangeuse_check = true;
		include("include/edituser.inc.php");
		$msg = edituser();;
    }
	
	if(isset($_POST['editusersave'])) {
		$shownaccess_active = true;
		
		include("include/edituser.inc.php");
		$msg = editusersave();
    }
	
	sendCommand(255,255);
	
	//get access
	 $access_row = querysql("SELECT `Relay 1`,`Relay 2`,`Relay 3`,`Relay 4`,`Relay 5`,`Relay 6`,`Relay 7`,`Relay 8`,`Relay All`,`Admin` FROM `Access`, `Login` WHERE `id` = `login_id` and `username`= \"$login_session\"");
	//end access save as array $access_row
	
	//get name
	$name_row = querysql("SELECT `Relay 1`,`Relay 2`,`Relay 3`,`Relay 4`,`Relay 5`,`Relay 6`,`Relay 7`,`Relay 8` FROM `Names`");
	//end get name saved to array  $name_row

    function sendCommand($relay,$state)
	{
            $socket = fsockopen('10.70.1.15',20000,$errno,$errstr);
            if(!$socket)
            {
                    echo $errno . ': ' . $errstr . PHP_EOL;
            }
            else
            {
                $cmdString = "\xFD\x02\x20" . chr($relay) . chr($state) . "\x5D";
                fwrite($socket,$cmdString);
                $res = fread($socket,20);
                fclose($socket);
                $res = substr($res,1,-1); // eliminate first and last char
                $bin = hexToBin($res); // each char is the state of a relay
                switch ($bin)
                    {
                    case  "0000000100000001":       
                        break;
                    case "0000000100000000":
                        break;
                    case "0000001000000001":
                        break;
                    case "0000001000000000":
                        break;
                    case "0000001100000001":
                        break;
                    case "0000001100000000":
                        break;
                    case "0000010000000001":
                        break;      
                    case "0000010000000000":
                        break;
                    case "0000010100000001":
                        break;
                    case "0000010100000000":
                        break;
                    case "0000011000000001":
                        break;
                    case "0000011000000000":
                        break;
                    case "0000011100000001":
                        break;
                    case "0000011100000000":
                        break;
                    case "0000100000000001":
                        break;
                    case "0000100000000000":
                        break;
                    case "1111100010001000":
                        break;
                    case "1111100010000000":
                        break;
                    default:
                        state($bin);
                    }
            }
            return $bin;	
	}
	
    function hexToBin($hex) 
	{
            $bin='';
            $j = strlen($hex);
            for ($i=0; $i < $j; $i++)
            $bin .= str_pad(decbin(ord($hex[$i])),8,'0',STR_PAD_LEFT);
            return $bin;
	} 
	
	function state($bin)
	{
		$rest = substr($bin, -1); 
		if ($rest == "1") 
		{
			$GLOBALS['r1'] = "On";
		}
		else
			{
				$GLOBALS['r1']  = "Off";
			}
			
		$rest = substr($bin, -2, 1); 
		if ($rest == "1") 
		{
			$GLOBALS['r2']  = "On";
		}
		else
			{
				$GLOBALS['r2']  = "Off";
			}
			
		$rest = substr($bin, -3, 1);
		if ($rest == "1") 
		{
			$GLOBALS['r3']  = "On";
	
		}
		else
			{
				$GLOBALS['r3']  = "Off";
			}
			
		$rest = substr($bin, -4, 1); 
		if ($rest == "1") 
		{
			$GLOBALS['r4']  = "On";
		}
		else
			{
				$GLOBALS['r4']  = "Off";
			}
			
		$rest = substr($bin, -5, 1); 
		if ($rest == "1") 
		{
			$GLOBALS['r5']  = "On";
		}
		else
			{
				$GLOBALS['r5']  = "Off";
			}
			
		$rest = substr($bin, -6, 1);
		if ($rest == "1") 
		{
			$GLOBALS['r6']  = "On";
	
		}
		else
			{
				$GLOBALS['r6']  = "Off";
			}
		
		$rest = substr($bin, -7, 1); 
		if ($rest == "1") 
		{
			$GLOBALS['r7']  = "On";
		}
		else
			{
				$GLOBALS['r7']  = "Off";
			}
			
		$rest = substr($bin, -8, 1);
		if ($rest == "1") 
		{
			$GLOBALS['r8']  = "On";
	
		}
		else
			{
				$GLOBALS['r8']  = "Off";
			}
	}
	
	
?>
<!DOCTYPE html>
<html>
    <head>
    <title>Relay</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <form name="Admin" action="profile.php" method="post">
            <div id="profile">
                <b id="welcome">Welcome : <i><?php echo $login_session; ?></i></b>
                <b id="logout"><a href="logout.php">Log Out</a></b>
            </div>
            <br>
            <table >
                
				<?php 	
				if ($passwordchangeusercheck)
						{
							include("include/passwdch.inc.php");
							echo passwordchangeuser();
						}
				else
				{
					if ($access_row['Relay 1']) 
					{
						echo "<tr>\n";
							if ($r1 == "On")
							{ 
								echo "<td colspan=\"2\"><input type=\"submit\" name=\"r1-off\" value=\"" . $name_row['Relay 1'] . "\" Class=\"inputtrue\"></td>\n";
							}
							else 
								{
									echo "<td colspan=\"2\"><input type=\"submit\" name=\"r1-on\" value=\"" . $name_row['Relay 1'] . "\" Class=\"inputfalse\"></td>\n";
								}	
						echo "<td></td>\n";
						echo "<td></td>\n";
						echo "</tr>\n";	
					}
					if ($access_row['Relay 2']) 
					{
						echo "<tr>\n";
							if ($r2 == "On")
							{
								echo "<td colspan=\"2\"><input type=\"submit\" name=\"r2-off\" value=\"" . $name_row['Relay 2'] . "\"  Class=\"inputtrue\"></td>\n";
							}
							else 
								{
									echo "<td colspan=\"2\"><input type=\"submit\" name=\"r2-on\" value=\"" . $name_row['Relay 2'] . "\"  Class=\"inputfalse\"></td>\n";
								}
						echo "<td></td>\n";
						echo "<td></td>\n";
						echo "</tr>\n";
					}
					if ($access_row['Relay 3']) 
					{
						echo "<tr>\n";
							if ($r3 == "On")
							{
								
								echo "<td colspan=\"2\"><input type=\"submit\" name=\"r3-off\" value=\"" . $name_row['Relay 3'] . "\"  Class=\"inputtrue\"></td>\n";
							}
							else 
								{
									echo "<td colspan=\"2\"><input type=\"submit\" name=\"r3-on\" value=\"" . $name_row['Relay 3'] . "\"  Class=\"inputfalse\"></td>\n";
								}
						echo "<td></td>\n";
						echo "<td></td>\n";
						echo "</tr>\n";
					}
					if ($access_row['Relay 4']) 
						{
						echo "<tr>\n";
							if ($r4 == "On")
							{
								echo "<td colspan=\"2\"><input type=\"submit\" name=\"r4-off\" value=\"" . $name_row['Relay 4'] . "\"  Class=\"inputtrue\"></td>\n";
							}
							else 
								{
									echo "<td colspan=\"2\"><input type=\"submit\" name=\"r4-on\" value=\"" . $name_row['Relay 4'] . "\"  Class=\"inputfalse\"></td>\n";
								}
						echo "<td></td>\n";
						echo "<td></td>\n";
						echo "</tr>\n";
					}
					if ($access_row['Relay 5']) 
					{
						echo "<tr>\n";
							if ($r5 == "On")
							{
								echo "<td colspan=\"2\"><input type=\"submit\" name=\"r5-off\" value=\"" . $name_row['Relay 5'] . "\"  Class=\"inputtrue\"></td>\n";
							}
							else 
								{
									echo "<td colspan=\"2\"><input type=\"submit\" name=\"r5-on\" value=\"" . $name_row['Relay 5'] . "\"  Class=\"inputfalse\"></td>\n";
								}
						echo "<td></td>\n";
						echo "<td></td>\n";
						echo "</tr>\n";
					}
					if ($access_row['Relay 6']) 
					{
						echo "<tr>\n";
							if ($r6 == "On")
							{
								echo "<td colspan=\"2\"><input type=\"submit\" name=\"r6-off\" value=\"" . $name_row['Relay 6'] . "\"  Class=\"inputtrue\"></td>\n";
							}
							else 
								{
									echo "<td colspan=\"2\"><input type=\"submit\" name=\"r6-on\" value=\"" . $name_row['Relay 6'] . "\"  Class=\"inputfalse\"></td>\n";
								}
						echo "<td></td>\n";
						echo "<td></td>\n";
						echo "</tr>\n";
					}
					if ($access_row['Relay 7']) 
						{
							echo "<tr>\n";
							if ($r7 == "On")
							{
								echo "<td colspan=\"2\"><input type=\"submit\" name=\"r7-off\" value=\"" . $name_row['Relay 7'] . "\"  Class=\"inputtrue\"></td>\n";
							}
							else 
								{
									echo "<td colspan=\"2\"><input type=\"submit\" name=\"r7-on\" value=\"" . $name_row['Relay 7'] . "\"  Class=\"inputfalse\"></td>\n";
								}
						echo "<td></td>\n";
						echo "<td></td>\n";
						echo "</tr>\n";
					}
					if ($access_row['Relay 8']) 
						{
						echo "<tr>\n";
							if ($r8 == "On")
							{
								echo "<td colspan=\"2\"><input type=\"submit\" name=\"r8-off\" value=\"" . $name_row['Relay 8'] . "\"  Class=\"inputtrue\"></td>\n";
							}
							else 
								{
									echo "<td colspan=\"2\"><input type=\"submit\" name=\"r8-on\" value=\"" . $name_row['Relay 8'] . "\"  Class=\"inputfalse\"></td>\n";
								}
						echo "<td></td>\n";
						echo "<td></td>\n";
						echo "</tr>\n";
					}
					if ($access_row['Relay All']) 
						{
						?>
						<tr>
							<td><input type="submit" name="r9-on" value="All Relays On"></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td><input type="submit" name="r9-off" value="All Relays Off"></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<?php
						}
						if ( !$editchangeuse_check)
						{
							?>
							<tr>
								<td colspan="2"><input type="submit" name="query" value="Query"></td> 
								<td></td>
								<td></td>
							</tr>
							<?php
						}
					if ($access_row['Admin']) 
						{
						?>
						<tr>
							<td colspan="2"><input type="submit" name="admin" value="Admin"></td> 
							<td></td>
							<td></td>
						</tr>
						<?php
						}
						else
						{
							if ( !$editchangeuse_check)
							{
								?>
								<tr>
									<td colspan="2"><input type="submit" name="passwordchangeuser" value="Change Password" ></td> 	
								</tr>
								<tr>
									<td colspan="2"><input type="submit" name="editchangeuser" value="Edit Info" ></td> 	
								</tr>
								
								
							<?php
							  
							}
							$msg .= "<tr>\n";
							$msg .= "	<td ><input type=\"submit\" name=\"goback\" value=\"Go Back To Main\" class=\"inputadmin\"></td>\n ";
							$msg .= "</tr>\n";
							echo $msg;
						}
						?>
					
				<?php
				}
				?>
            </table> 
			<input type="hidden" value="<?php echo $login_session; ?>" name="username" />
        </form>
    </body>
</html>
