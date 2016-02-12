<?php
	error_reporting(E_ALL);
	require("config.php");
	/******************
	Make SQL Call 
	******************/
	function query($sql) 
	{
		global $connection;
		$result = mysqli_query($connection, $sql) or die();
		return $result;
	}

	/******************
	Get SQL Num Rows
	******************/
	function get_num_rows($sql)
	{
		$num = mysqli_num_rows($sql);  
		return $num;
	}

	/******************
	Fetch SQL Array
	******************/
	function fetch_array($sql , $optional='')
	{
		if($optional != ''){
			$fetch = mysqli_fetch_array($sql , $optional); //2nd optional param = MYSQLI_ASSOC (mysqli_fetch_assoc()) or MYSQLI_NUM (mysqli_fetch_row())  or MYSQLI_BOTH (returns single array with features of the other two) 
		}else{
			$fetch = mysqli_fetch_array($sql);       
		}
		return $fetch;
	}
	
	/******************
	Connection
	******************/
	$connection = mysqli_connect($dbhost,$dbusername,$dbpassword,$dbdatabase);
	if (mysqli_connect_errno($connection)) 
	{
	//echo mysqli_connect_error();
	die("Database connection failed: " . mysqli_connect_error());
	}
	
	/******************
	Update
	******************/
	function updatenames($relay1,$relay2,$relay3,$relay4,$relay5,$relay6,$relay7,$relay8)
	{
		global $dbhost;
		global $dbdatabase;
		global $dbusername;
		global $dbpassword;
		try
		 {
			
				$conn = new PDO("mysql:host=$dbhost; dbname=$dbdatabase", $dbusername, $dbpassword);
				$conn->exec("SET CHARACTER SET utf8");      // Sets encoding UTF-8
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			

				$sql = "UPDATE `Names`  
				SET  
					`Relay 1` = :relay1, 
					`Relay 2` = :relay2, 
					`Relay 3` = :relay3, 
					`Relay 4` = :relay4, 
					`Relay 5` = :relay5, 
					`Relay 6` = :relay6, 
					`Relay 7` = :relay7, 
					`Relay 8` = :relay8  
				WHERE `id`=0";


				$statement = $conn->prepare($sql);
				$statement->bindValue(":relay1", $relay1);
				$statement->bindValue(":relay2", $relay2);
				$statement->bindValue(":relay3", $relay3);
				$statement->bindValue(":relay4", $relay4);
				$statement->bindValue(":relay5", $relay5);
				$statement->bindValue(":relay6", $relay6);
				$statement->bindValue(":relay7", $relay7);
				$statement->bindValue(":relay8", $relay8); 
				$count = $statement->execute();
				
				$conn = null;        // Disconnect
			}
			catch(PDOException $e) 
			{
				return $e->getMessage();
			}
			// If the query is succesfully performed ($count not false)
			if($count != false) return 'Affected rows : ' . $count;       // Shows the number of affected rows
	}
?>