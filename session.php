<?php
    
	require_once("sqli.php");			//our file which holds our sql functions
	
	session_start();// Starting Session
	// Storing Session
	$user_check=$_SESSION['login_user'];
	// SQL Query To Fetch Complete Information Of User
	$ses_sql=query("select username from Login where username='$user_check'");
	$row = fetch_array($ses_sql);
	$login_session =$row['username'];
	if(!isset($login_session))
	{
		header('Location: index.php'); // Redirecting To Home Page
	}
?>