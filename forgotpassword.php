<?php


if(isset($_SESSION['login_user']))
{
	header("location: index.php?u=".$_SESSION["username"]);
    exit();
}
?><?php
	// AJAX CALLS THIS CODE TO EXECUTE
	if(isset($_POST["email"]))
	{
		require_once("include/sqli.inc.php");
		$email = $_POST["email"];
		$row = email_id($email);
		if($row > 0)
		{
			$id = $row["id"];
			$username = $row["username"];
			$emailcut = substr($email, 0, 4);
			$randNum = rand(10000,99999);
			$tempPass = "$emailcut$randNum";
			$hashTempPass = md5($tempPass);
			//$sql = "UPDATE useroptions SET temp_pass='$hashTempPass' WHERE username='$u' LIMIT 1";
			//$query = mysqli_query($db_conx, $sql);
			$to = "$email";
			$from = "auto_responder@yoursite.com";
			$headers ="From: $from\n";
			$headers .= "MIME-Version: 1.0\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1 \n";
			$subject ="yoursite Temporary Password";
			$msg = '<h2>Hello '.$u.'</h2><p>This is an automated message from yoursite. If you did not recently initiate the Forgot Password process, please disregard this email.</p><p>You indicated that you forgot your login password. We can generate a temporary password for you to log in with, then once logged in you can change your password to anything you like.</p><p>After you click the link below your password to login will be:<br /><b>'.$tempPass.'</b></p><p><a href="http://www.yoursite.com/forgot_pass.php?u='.$u.'&p='.$hashTempPass.'">Click here now to apply the temporary password shown below to your account</a></p><p>If you do not click the link in this email, no changes will be made to your account. In order to set your login password to the temporary password you must click the link above.</p>';
			if(mail($to,$subject,$msg,$headers)) {
				echo "success";
				exit();
			} else {
				echo "email_send_failed";
				exit();
			}
		} else {
			echo "no_exist";
		}
		exit();
	}

	// EMAIL LINK CLICK CALLS THIS CODE TO EXECUTE
	if(isset($_GET['u']) && isset($_GET['p'])){
		$u = preg_replace('#[^a-z0-9]#i', '', $_GET['u']);
		$temppasshash = preg_replace('#[^a-z0-9]#i', '', $_GET['p']);
		if(strlen($temppasshash) < 10){
			exit();
		}
		$sql = "SELECT id FROM useroptions WHERE username='$u' AND temp_pass='$temppasshash' LIMIT 1";
		$query = mysqli_query($db_conx, $sql);
		$numrows = mysqli_num_rows($query);
		if($numrows == 0){
			header("location: message.php?msg=There is no match for that username with that temporary password in the system. We cannot proceed.");
			exit();
		} else {
			$row = mysqli_fetch_row($query);
			$id = $row[0];
			$sql = "UPDATE users SET password='$temppasshash' WHERE id='$id' AND username='$u' LIMIT 1";
			$query = mysqli_query($db_conx, $sql);
			$sql = "UPDATE useroptions SET temp_pass='' WHERE username='$u' LIMIT 1";
			$query = mysqli_query($db_conx, $sql);
			header("location: login.php");
			exit();
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Forgot Password</title>
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		<link href="style.css" rel="stylesheet" type="text/css">
		<meta http-equiv="X-Frame-Options" content="deny">
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

 