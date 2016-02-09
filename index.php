<?php
require_once("connection.php");  	//include your connection to your db
	require_once("sqli.php");			//our file which holds our sql functions 
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
            // Define $username and $password
            $username=$_POST['username'];
            $password=$_POST['password'];
            
            // To protect MySQL injection for Security purpose
            $username = stripslashes($username);
            $password = stripslashes($password);
            $username = mysqli_real_escape_string($connection,$username);
            $password = mysqli_real_escape_string($connection,$password);
            // Selecting Database
          
            $query = query("select * from login where password='$password' AND username='$username'");
            $rows = get_num_rows($query);
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

if(isset($_SESSION['login_user'])){
header("location: profile.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
    <title>Login Form</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="main">
            <h1>Login</h1>
            <div id="login">
                <h2>Login Form</h2>
                <form action="index.php" method="post">
                    <label>UserName :</label>
                    <input id="name" name="username" placeholder="username" type="text">
                    <label>Password :</label>
                    <input id="password" name="password" placeholder="**********" type="password">
                    <input name="submit" type="submit" value="Login" Class="inputother">
                    <span><?php echo $error; ?></span>
                </form>
        </div>
        </div>
    </body>
</html>