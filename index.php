<?php
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
					
					$encrypt_password="*" . sha1(sha1($password,true));
					$rows = userpassword($username,$encrypt_password) ;
					
					if ($rows == 1) {
						$_SESSION['login_user']=$username; // Initializing Session
						header("location: profile.php"); // Redirecting To Other Page
						} 
						else 
						{
							$error = "Username or Password is invalid";	
						}
				}
			}
        }
    }
	else
	{
		$token = bin2hex(openssl_random_pseudo_bytes(16));
        setcookie("CSRFtoken", $token, time() + 60 * 60 * 24);
	}

if(isset($_SESSION['login_user'])){
header("location: profile.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
    <title>Login Form</title>
    <link href="style.css" rel="stylesheet" type="text/css">
	<meta http-equiv="X-Frame-Options" content="deny">
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
							<td  colspan="2"><span>  </span></td>
						</tr>
						<tr>
							<td  colspan="2"><input name="submit" type="submit" value="Login" ></td>
						</tr>
						
						<tr>
							<td  colspan="2"><span><?php echo $error; ?></span></td>
						</tr>
					</table>
					<input name="CSRFtoken" type="hidden" value="<?php echo $token ?>">
					<br>	
						
                </form>
        </div>
        </div>
    </body>
</html>