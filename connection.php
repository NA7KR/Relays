<?php
require("config.php");

//*SQLi
//Create a database connection
$connection = mysqli_connect($dbhost,$dbusername,$dbpassword,$dbdatabase);
if (mysqli_connect_errno($connection)) {
	//echo mysqli_connect_error();
	die("Database connection failed: " . mysqli_connect_error());
}

?>
