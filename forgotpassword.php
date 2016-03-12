<?php
	require_once("include/sqli.inc.php");

	if(isset($_SESSION['login_user']))
	{
		header("location: index.php?u=".$_SESSION["username"]);
		exit();
	}

	/******************
	AJAX CALLS THIS CODE TO EXECUTE
	******************/
	if(isset($_POST["email"]))
	{
		
		$email = $_POST["email"];
		$row = email_id($email);
		if($row > 0)
		{
			$ip = get_ip();
			$sql = "SELECT `Tries`,`IP_Address`,COUNT('') as 'Attempts' FROM `Security` Where `IP_Address` = '$ip' AND `Tries` = 1 Group By `IP_Address`,`Tries`";
			$attemptrow = querysql($sql);
			$Attempts = $attemptrow["Attempts"];
			$headers ="From: $from\n";
			$headers .= "MIME-Version: 1.0\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1 \n";
			$id = $row["id"];
			$username = $row["username"];
			if ($Attempts < 3)
			{
				$emailcut = substr($email, 0, 4);
				$randNum = rand(10000,99999);
				$tempPass = "$emailcut$randNum";
				$encrypt_password="*" . sha1(sha1($tempPass,true));
				//savepasswordmysql($username,$encrypt_password);
				$sql = "UPDATE `Login` SET `temp_pass`='$encrypt_password' WHERE `username`='$username' LIMIT 1";
				querysql($sql);
				
				$sql = "INSERT INTO `Security` ( `IP_Address`, `Action`,`Username`) VALUES ( '$ip', 'Reset','$username')";
				querysql($sql);
				$to = "$email";
				$subject ="Temporary Password";
				$msg = '<h2>Hello '. $username .'</h2><p>This is an automated message from yoursite. If you did not recently initiate the Forgot Password process, please disregard this email.</p><p>You indicated that you forgot your login password. We can generate a temporary password for you to log in with, then once logged in you can change your password to anything you like.</p><p>After you click the link below your password to login will be:<br /><b>'.$tempPass.'</b></p><p><a href="https://relay.na7kr.us/forgotpassword.php?u='.$username.'&p='.$encrypt_password.'">Click here now to apply the temporary password shown below to your account</a></p><p>If you do not click the link in this email, no changes will be made to your account. In order to set your login password to the temporary password you must click the link above.</p>';
				if(mail($to,$subject,$msg,$headers)) {
					$msg = "<h3>Sent Email.</h3>";
					$msg .= "<br>";
					html_function("Reset Password",$msg,$site);
					exit();
				} 
				else 
				{
					$msg = "<h3>Failed</h3>";
					$msg .= "<br>";
					html_function("Reset Password",$msg,$site);
					exit();
				}
			}
			else
			{
				$sql = "UPDATE `Login` SET `activated`='0' WHERE `username`='$username' LIMIT 1";
				querysql($sql);
				$subject ="Locked out";
				$emsg = "User " . $username . " with IP " . $ip . " Is locked out";
				if(mail($email,$subject,$emsg,$headers)) 
				$msg = "<h3>Failed</h3>";
				$msg .= "<br>";
				$msg .= "<h3>The admin has beed emailed that your locked out.</h3>";
				$msg .= "<br>";
				html_function("Locked out",$msg,$site);
				exit();
			}
		} else {
			$msg = "<h3>User not found</h3>";
				$msg .= "<br>";
				html_function("Reset Password",$msg,$site);
				exit();
		}
		exit();
	}

	/******************
	EMAIL LINK CLICK CALLS THIS CODE TO EXECUTE
	******************/
	if(isset($_GET['u']) && isset($_GET['p']))
	{
		$u =  $_GET['u'];
		$temppasshash =  $_GET['p'];
		if(strlen($temppasshash) < 10){
			session_destroy();
			exit();
		}
		$sql = "SELECT `id` FROM `Login` WHERE `username` = '$u' AND `temp_pass` = '$temppasshash' ";
		$access_row = querysql($sql);
		
		$id = $access_row['id'];
		$debug = false;
		if ($debug)
		{
			echo $id . "id \n";
			echo $u . "u \n";
			echo $temppasshash . "p \n";
		}
		//$query = mysqli_query($db_conx, $sql);
		//$numrows = mysqli_num_rows($query);
		if($access_row == 0){
			$msg = "<h1>Password not reset Password</h1>";
			$msg .=	"<h3>There is no match for that username with that temporary password in the system. We cannot proceed.</h3>";
			$msg .=	"<br>";
			$msg .=	"<h3>Please login with password or reset.</h3>";
			$msg .=	"<br>";
			html_function("Password not reset Password",$msg,$site);
			exit();
		} else {
			
			$sql = "UPDATE `Login` SET `password`='$temppasshash' WHERE `id`='$id' AND `username`='$u' ";
			querysql($sql);
			//clear temp password
			$sql = "UPDATE `Login` SET `temp_pass`='' WHERE `username`='$u' ";
			querysql($sql);
			// set forece change
			$sql = "UPDATE `Login` SET `ChangePassword`='1' WHERE `username`='$u' ";
			querysql($sql);
			$msg = "<h3>Please login with new password.</h3>";
			$msg .= "<br>";
			html_function("Reset Password",$msg,$site);
			exit();
		}
	}
	
	/******************
	HTML Code
	******************/
	function html_function($tile,$msg,$site)
	{
		?>
		<!DOCTYPE html>
			<html>
				<head>
					<meta charset="UTF-8">
					<title><?php echo $tile ?></title>
					<link rel="icon" href="favicon.ico" type="image/x-icon">
					<link href="style.css" rel="stylesheet" type="text/css">
					<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
					<META HTTP-EQUIV="refresh" CONTENT="30; url=<?php echo $site; ?>">
				</head>
				<body>

					<div id="pageMiddle">
						<div id="main">
							<h1><?php echo $tile ?></h1>
							<h3><?php echo $msg ?></h3>
							<br>
							<div style="text-align:center">    
								<a href="<?php echo $site ?>"><?php echo $site ?></a> 
							</div>
						</div>
					</div>
					<?php include_once("include/pageBottom.php"); ?>
				</body>
			</html>
		<?php
	}
	
	/******************
	Get IP
	******************/
	function get_ip() 
	{
		//Just get the headers if we can or else use the SERVER global
		if ( function_exists( 'apache_request_headers' ) ) 
		{
			$headers = apache_request_headers();
		} 
		else 
			{
				$headers = $_SERVER;
			}
		//Get the forwarded IP if it exists
		if ( array_key_exists( 'X-Forwarded-For', $headers ) && filter_var( $headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) ) 
		{
			$the_ip = $headers['X-Forwarded-For'];
		} 
		elseif 
			( 
				array_key_exists( 'HTTP_X_FORWARDED_FOR', $headers ) && filter_var( $headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 )
			) 
			{
				$the_ip = $headers['HTTP_X_FORWARDED_FOR'];
			} 
		else 
		{
			$the_ip = filter_var( $_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );
		}
		return $the_ip;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Forgot Password</title>
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		<link href="style.css" rel="stylesheet" type="text/css">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	</head>
	<body>
		<div id="pageMiddle">
			<div id="main">
            <h1>Forgotten Password</h1>
            <div  class="absoluteCenter" id="login">
                <h2>Forgotten Password Form</h2>
				<form id="forgotpassform" method="post">
					<br>
					<br>
					<div>Step 1: Enter Your Email Address</div>
					<table>
						<tr>
							<td><td><input id="email" name="email" placeholder="email" type="text"></td></td>
						</tr>
						<tr>
							<td  colspan="2"><span>  </span></td>
						</tr>
						<tr>
							<td  colspan="2"><span>  </span></td>
						</tr>
						<tr>
							<td  colspan="2"><span>  </span></td>
						</tr>
						<tr>
							<td  colspan="2"><input name="submit" type="submit" value="Request Password" ></td>
						</tr>
					<p id="status"></p>
				</form>
			</div>
		</div>
		<?php include_once("include/pageBottom.php"); ?>
	</body>
</html>

 