<?php
    include('config.php'); 
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
            // Establishing Connection with Server by passing server_name, user_id and password as a parameter
            $con = mysqli_connect($dbhost, $dbusername, $dbpassword);
            // To protect MySQL injection for Security purpose
            $username = stripslashes($username);
            $password = stripslashes($password);
            $username = mysql_real_escape_string($username);
            $password = mysql_real_escape_string($password);
            // Selecting Database
            $db = mysqli_select_db($dbdatabase, $con);
            // SQL query to fetch information of registerd users and finds user match.
            $query = mysqli_query("select * from login where password='$password' AND username='$username'", $con);
            $rows = mysqli_num_rows($query);
            if ($rows == 1) {
                    $_SESSION['login_user']=$username; // Initializing Session
                    header("location: profile.php"); // Redirecting To Other Page
                    } 
                    else 
                    {
                            $error = "Username or Password is invalid";
                    }
                    mysqli_close($con); // Closing Connection
        }
    }
