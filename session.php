<?php
        include('config.php'); 
	// Establishing Connection with Server by passing server_name, user_id and password as a parameter
	$con=  \mysqli_connect($dbhost,$dbusername,$dbpassword,$dbdatabase);
	// Selecting Database
	$db = \mysqli_select_db($dbdatabase, $con);
	session_start();// Starting Session
	// Storing Session
	$user_check=$_SESSION['login_user'];
	// SQL Query To Fetch Complete Information Of User
	$ses_sql=mysqli_query("select username from login where username='$user_check'", $con);
	$row = mysqli_fetch_assoc($ses_sql);
	$login_session =$row['username'];
	if(!isset($login_session))
	{
		mysqli_close($con); // Closing Connection
		header('Location: index.php'); // Redirecting To Home Page
	}
?>
