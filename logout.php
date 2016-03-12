<?php
	session_start();
	/******************
	logout
	******************/
	if(session_destroy()) // Destroying All Sessions
	{
		header("Location: index.php"); // Redirecting To Home Page
	}
?>
