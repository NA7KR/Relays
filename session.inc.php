<?php
	require_once("sqli.php");			
	session_start();// Starting Session
	/******************
	Storing Session 
	******************/
	$user_check=$_SESSION['login_user'];
	$row = usercheck($user_check);
	$login_session =$row['username'];
	if(!isset($login_session))
	{
		header('Location: index.php'); // Redirecting To Home Page
	}
	/******************
	Check if login or not 
	******************/
?>