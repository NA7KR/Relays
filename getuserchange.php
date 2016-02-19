<?php
	require_once("sqli.php");	
	$q = intval($_GET['q']);
	echo showuserinfo($q);
 ?>
