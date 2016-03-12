<?php
	session_start();
	require_once("include/sqli.inc.php");	
	$q = intval($_GET['q']);
	echo showuserinfo($q);
 ?>
