<?php
$filename = 'install.php';

if (file_exists($filename)) {
    echo "The file $filename exists <br>";
	echo "Please run http://" . $_SERVER["SERVER_NAME"] ."/install.php<br>";
	echo "Then delete it";
} 
	else {
		require_once("include/sqli.inc.php");			//our file which holds our sql functions 
		session_start(); // Starting Session
		$error=''; // Variable To Store Error Message
			if (isset($_POST['submit'])) 
			{		
				if (empty($_POST['username']) || empty($_POST['password'])) 
				{
						$error = "Username or Password is invalid";
				}
				else
				{
					if (isset($_POST['CSRFtoken'], $_COOKIE['CSRFtoken']))
					{	
						if ($_POST['CSRFtoken'] == $_COOKIE['CSRFtoken'])
						{
							// Define $username and $password
							$username=$_POST['username'];
							$password=$_POST['password']; 
							//check if table present
							tableExists("Access");
							tableExists("Login");
							tableExists("Names");
							tableExists("Security");
							//Check if locked out
							$sql = "SELECT * FROM `Login` WHERE `activated`='1' and `username`='$username' LIMIT 1";
							$notlocked = querysql($sql);
							if ($notlocked > 0)
							{
								$encrypt_password="*" . sha1(sha1($password,true));
								$rows = userpassword($username,$encrypt_password) ;
								$sql = "UPDATE `Security` SET `Tries`='0' WHERE `username`='$username' and  `Tries`='1'";
								querysql($sql);
												
								if ($rows == 1) 
								{
									$sql = "SELECT `activated` FROM Login WHERE `username`  = '$username' AND `ChangePassword` = 1 ";
									$cprows = querysql($sql);
									if ($cprows['activated'] == 1)
									{	
										$_SESSION['username'] = $username;
										$_SESSION['active'] = true;
										$error .= "<a href=\"http://relay.na7kr.us/pwchange.php\" onclick=\"javascript:void window.open('http://relay.na7kr.us/pwchange.php','1457384969085','width=750,height=500,toolbar=0,menubar=0,location=0,status=1,scrollbars=0,resizable=1,left=0,top=0');return false;\">You must change password!</a>";
									}
									else
										{
											$_SESSION['login_user']=$username; // Initializing Session
											header("location: profile.php"); // Redirecting To Other Page
										}
								} 
									else 
									{
										$error = "Username or Password is invalid";	
									}
							}
								else
								{
									$error = "Locked out or not found";	
								}
						}
					}
				}
				
			}
			else
			{
				$token = bin2hex(openssl_random_pseudo_bytes(16));
				setcookie("CSRFtoken", $token, time() + 60 * 60 * 24);
				$_SESSION['token'] = $token;
			}
			
		if(isset($_SESSION['login_user'])){
		header("location: profile.php");
		}

		if(isset($_SESSION['token'])){
		$token = $_SESSION['token'];
		}

		?>
		<!DOCTYPE html>
		<html>
			<head>
			<title>Login Form</title>
			<link href="style.css" rel="stylesheet" type="text/css">
			<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
			</head>
			<body>
				<div id="main">
					<h1>Login</h1>
					<div  class="absoluteCenter" id="login">
						<h2>Login Form</h2>
						<form action="index.php" method="post">
						<br>
						<br>
							<table>
								<tr>
									<td>UserName:</td>
									<td><input id="name" name="username" placeholder="username" type="text"></td>
								</tr>
								<tr>
									<td>Password:</td>
									<td><input id="password" name="password" placeholder="**********" type="password"></td>
								</tr>
								<tr>
									<td  colspan="2"><span>  </span></td>
								</tr>
								<tr>
									<td  colspan="2"><span>  </span></td>
								</tr>
								<tr>
									<td  colspan="2"><input name="submit" type="submit" value="Login" ></td>
								</tr>
								
								<tr>
									<td  colspan="2"><span><?php echo $error; ?></span></td>
								</tr>
								<tr>
									<td colspan="2"><a href="<?php echo $site . "/forgotpassword.php"?>">Reset Password</a></td>
								</tr>
							</table>
							<input name="CSRFtoken" type="hidden" value="<?php echo $token ?>">
							<br>	
								
						</form>
				</div>
				</div>
				<?php include_once("include/pageBottom.php"); ?>
			</body>
		</html>
		<?php
}
?>
