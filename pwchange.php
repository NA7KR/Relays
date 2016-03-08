<?php
	$error = "";
	$username = "";
	$msg = "";
	session_start(); // Starting Session
	require_once("include/sqli.inc.php");
	
	if(isset($_POST['passwordchangesave'])) {
		$username=$_POST['username'];
		$password1=$_POST['password1']; 
		$passwordold=$_POST['passwordold']; 
		if ($passwordold == "")
		{
			$msg = "Password change failed need temp password..";
		}
		else
			{
				$encrypt_password="*" . sha1(sha1($passwordold,true));
				$rows = userpassword($username,$encrypt_password) ;				
				if ($rows == 1)
				{
					$encrypt_password="*" . sha1(sha1($password1,true));
				    $save = savepasswordmysql($username,$encrypt_password);
					if ($save =="1")
					{
						$msg .= "Saved " .  $_POST['username']  ;
						$sql = "UPDATE `Login` SET `ChangePassword`='0' WHERE `username`='$u' ";
						querysql($sql);
						sleep(10); 
						?>
							<script type='text/javascript'>
								window.open('location', '_self', '');
								window.close();
							</script>
						<?php
					}
					else 
						{
							$msg = "Failed";
						}
				}
			
				else
				{
					$msg = "Temp Password does match";
				}
			}
    }
	
	if(isset($_SESSION['active']))
	{
		$username = $_SESSION['username'];
		$token = $_SESSION['token'];
		$sql = "UPDATE `Login` SET `ChangePassword`='0' WHERE `username`='$username' ";
		querysql($sql);
	

		if ($username !== "")
			{	
			?>	
			<!DOCTYPE html>
			<html>
				<head>
				<?php include("include/java.inc.php"); ?>
				<title>Change password</title>
				<link href="style.css" rel="stylesheet" type="text/css">
				<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
				</head>
				<body>
					<div id="main">
						<h1>Change Password</h1>
						<div  class="absoluteCenter" id="login">
							<h2>Change Password for <?php echo $username ?></h2>
							
							<form name="Admin" action="pwchange.php" method="post">
							<?php echo password($username) ; ?>
							<?php echo $msg ; ?>
							</form>
					</div>
					</div>
					<?php include_once("include/pageBottom.php"); ?>
				</body>
			</html>	
			<?php

			}
			else 
				{
				?>
				<script type='text/javascript'>
					window.open('location', '_self', '');
					window.close();
				</script>
				<?php
				}
	
	}


function password($username)
{
			
	$msg =  "<input type=\"hidden\" value=\"1\" name=\"passwordchangesave\" >\n";
	$msg .= "<input type=\"hidden\" value=" . $username ." name=\"username\" >";
	$msg .= "Temp Password \n";
	$msg .= "<input name=\"passwordold\" type=\"password\"   >\n";
	$msg .= "<br \n>";
	$msg .= "New Password \n";
	$msg .= "<input name=\"password1\" type=\"password\" onkeyup=\"CheckPasswordStrength(this.value)\"  >\n";
	$msg .= "<span id=\"password_strength\"></span>";
	$msg .= "<br>Paaword Again \n";
	$msg .= "<br>\n";
	$msg .= "<input name=\"password2\" type=\"password\" onkeyup=\"validate()\" >\n";
	$msg .= "<div id=\"nameValidation\" class=\"validation-image\"></div>\n";
	$msg .= "<br>\n";
	
	$msg .= "<table>\n";
	
	$msg .= "<tr>\n";
	$msg .= "  <td><input type=\"submit\" name=\"savepasswd\"  id=\"savepasswd\" value=\"Save Password\" class=\"inputadminfalse\" disabled></td>\n";
	$msg .= "</tr>\n";
	$msg .= "</table>\n";
	return $msg;	
}
?>