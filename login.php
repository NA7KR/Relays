<?php
    require_once("connection.php");  	//include your connection to your db
	require_once("sqli.php");			//our file which holds our sql functions 
    session_start(); // Starting Session
    $error=''; // Variable To Store Error Message
    if (isset($_POST['submit'])) 
    {
        if (empty($_POST['username']) || empty($_POST['password'])) 
        {
                $error = "Username or Password is invalid + ". $_POST['username'];
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
