<?php
    include('config.php');
    include('session.php');
	

    if(isset($_GET['r1-on'])) {
        sendCommand(1,1,$debug);
    }
    if(isset($_GET['r1-off'])) {
        sendCommand(1,0,$debug);
    }
    if(isset($_GET['r2-on'])) {
        sendCommand(2,1,$debug);
    }
    if(isset($_GET['r2-off'])) {
        sendCommand(2,0,$debug);
    }
    if(isset($_GET['r3-on'])) {
        sendCommand(3,1,$debug);
    }
    if(isset($_GET['r3-off'])) {
        sendCommand(3,0,$debug);
    }
    if(isset($_GET['r4-on'])) {
        sendCommand(4,1,$debug);
    }
    if(isset($_GET['r4-off'])) {
        sendCommand(4,0,$debug);
    }
    if(isset($_GET['r5-on'])) {
        sendCommand(5,1,$debug);
    }
    if(isset($_GET['r5-off'])) {
        sendCommand(5,0,$debug);
    }
    if(isset($_GET['r6-on'])) {
        sendCommand(6,1,$debug);
    }
    if(isset($_GET['r6-off'])) {
        sendCommand(6,0,$debug);
    }
   if(isset($_GET['r7-on'])) {
        sendCommand(7,1,$debug);
    }
    if(isset($_GET['r7-off'])) {
        sendCommand(7,0,$debug);
    }
    if(isset($_GET['r8-on'])) {
        sendCommand(8,1,$debug);
    }
    if(isset($_GET['r8-off'])) {
        sendCommand(8,0,$debug);
    }
    if(isset($_GET['r9-on'])) {
        sendCommand(248,136,$debug);
    }
    if(isset($_GET['r9-off'])) {
        sendCommand(248,128,$debug);
    }
	if(isset($_GET['query'])) {
        sendCommand(255,255,$debug); //FD 02 20 FF FF 5D
    }
	sendCommand(255,255,$debug);
	
    function sendCommand($relay,$state,$debug)
	{
            $socket = fsockopen('10.70.1.15',20000,$errno,$errstr);
            if(!$socket)
            {
                    echo $errno . ': ' . $errstr . PHP_EOL;
            }
            else
            {
                if ($debug == true)
                {
                        echo $relay . " Relay /n";
                        echo $state . " State /n";
                }
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
                        echo "Relay All on <br>";
                        break;
                    case "1111100010000000":
                        echo "Relay All off <br>";
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
        <form action="profile.php" method="get">
            <div id="profile">
                <b id="welcome">Welcome : <i><?php echo $login_session; ?></i></b>
                <b id="logout"><a href="logout.php">Log Out</a></b>
            </div>
            <br>
            <table >
                <tr>
				<?php 
				if ($r1 == "On")
				{ 
                    echo "<td colspan=\"2\"><input type=\"submit\" name=\"r1-off\" value=\"on\" Class=\"inputdisabledtrue\"></td>\n";
                    echo "<td>Relay 1 State=On</td>\n";
				}
				else 
					{
						echo "<td colspan=\"2\"><input type=\"submit\" name=\"r1-on\" value=\"off\" Class=\"inputdisabledfalse\"></td>\n";
						echo "<td>Relay 1 State=Off</td>\n";
					}
				echo "</tr>";
				echo "<tr>";
				if ($r2 == "On")
				{
                    echo "<td colspan=\"2\"><input type=\"submit\" name=\"r2-off\" value=\"on\"  Class=\"inputdisabledtrue\"></td>\n";
                    echo "<td>Relay 2 State=On</td>\n";
				}
				else 
					{
						echo "<td colspan=\"2\"><input type=\"submit\" name=\"r2-on\" value=\"off\"  Class=\"inputdisabledfalse\"></td>\n";
						echo "<td>Relay 2 State=Off</td>\n";
					}
				echo "</tr>";
				echo "<tr>";
				if ($r3 == "On")
				{
					
                    echo "<td colspan=\"2\"><input type=\"submit\" name=\"r3-off\" value=\"on\"  Class=\"inputdisabledtrue\"></td>\n";
                    echo "<td>Relay 3 State=On</td>\n";
				}
				else 
					{
						echo "<td colspan=\"2\"><input type=\"submit\" name=\"r3-on\" value=\"off\"  Class=\"inputdisabledfalse\"></td>\n";
						echo "<td>Relay 3 State=Off</td>\n";
					}
				echo "</tr>";
				echo "<tr>";
				if ($r4 == "On")
				{
                    echo "<td colspan=\"2\"><input type=\"submit\" name=\"r4-off\" value=\"on\"  Class=\"inputdisabledtrue\"></td>\n";
                    echo "<td>Relay 4 State=On</td>\n";
				}
				else 
					{
						echo "<td colspan=\"2\"><input type=\"submit\" name=\"r4-on\" value=\"off\"  Class=\"inputdisabledfalse\"></td>\n";
						echo "<td>Relay 4 State=Off</td>\n";
					}
				echo "</tr>";
				echo "<tr>";
				if ($r5 == "On")
				{
                    echo "<td colspan=\"2\"><input type=\"submit\" name=\"r5-off\" value=\"on\"  Class=\"inputdisabledtrue\"></td>\n";
                    echo "<td>Relay 5 State=On</td>\n";
				}
				else 
					{
						echo "<td colspan=\"2\"><input type=\"submit\" name=\"r5-on\" value=\"off\"  Class=\"inputdisabledfalse\"></td>\n";
						echo "<td>Relay 5 State=Off</td>\n";
					}
				echo "</tr>";
				echo "<tr>";
				if ($r6 == "On")
				{
                    echo "<td colspan=\"2\"><input type=\"submit\" name=\"r6-off\" value=\"on\"  Class=\"inputdisabledtrue\"></td>\n";
                    echo "<td>Relay 6 State=On</td>\n";
				}
				else 
					{
						echo "<td colspan=\"2\"><input type=\"submit\" name=\"r6-on\" value=\"off\"  Class=\"inputdisabledfalse\"></td>\n";
						echo "<td>Relay 6 State=Off</td>\n";
					}
				echo "</tr>";
				echo "<tr>";
				if ($r7 == "On")
				{
                    echo "<td colspan=\"2\"><input type=\"submit\" name=\"r7-off\" value=\"off\"  Class=\"inputdisabledtrue\"></td>\n";
                    echo "<td>Relay 3 State=On</td>\n";
				}
				else 
					{
						echo "<td colspan=\"2\"><input type=\"submit\" name=\"r7-on\" value=\"on\"  Class=\"inputdisabledfalse\"></td>\n";
						echo "<td>Relay 7 State=Off</td>\n";
					}
				echo "</tr>";
				echo "<tr>";
				if ($r8 == "On")
				{
                    echo "<td colspan=\"2\"><input type=\"submit\" name=\"r8-off\" value=\"on\"  Class=\"inputdisabledtrue\"></td>\n";
                    echo "<td>Relay 8 State=On</td>\n";
				}
				else 
					{
						echo "<td colspan=\"2\"><input type=\"submit\" name=\"r8-on\" value=\"off\"  Class=\"inputdisabledfalse\"></td>\n";
						echo "<td>Relay 8 State=Off</td>\n";
					}
				echo "</tr>";
				?>
              
                <tr>
                    <td><input type="submit" name="r9-on" value="on" class="inputother"></td>
                    <td><input type="submit" name="r9-off" value="off" class="inputother"></td> 
                    <td>Relay All</td>
                </tr>
				<tr>
                    <td><input type="submit" name="query" value="on" class="inputother"></td> 
                    <td>Query</td>
                </tr>
            </table> 			 
        </form>
    </body>
</html>
