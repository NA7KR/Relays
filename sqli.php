<?php
	error_reporting(E_ALL);
	require("config.php");
	
	/******************
	Connection PDO
	******************/
	try
		{
			$conn = new PDO("mysql:host=$dbhost; dbname=$dbdatabase", $dbusername, $dbpassword);
			$conn->exec("SET CHARACTER SET utf8");      // Sets encoding UTF-8
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
	catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	
	/******************
	Make SQL Call 
	******************/
	function querysql($sql) 
	{
		echo $sql;
		global $conn;
		try
		{
			$statement = $conn->prepare($sql);
			$statement->execute();	
			$result=$statement->fetch(PDO::FETCH_ASSOC);
			return $result;	
		}
		catch(PDOException $e) 
		{
				return $e->getMessage();
		}
	}

	
	/******************
	Update Realay Names
	******************/
	function updatenames($relay1,$relay2,$relay3,$relay4,$relay5,$relay6,$relay7,$relay8)
	{
		global $conn;
		try
		 {
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
	
	/******************
	Read UserName and Password
	******************/
	function userpassword($user,$password)
	{
		global $conn;
		try
		{
			$sql = "SELECT * FROM Login WHERE `username` = :user AND `password` = :password"; 
			$statement = $conn->prepare($sql);
			$statement->bindParam(":user", $user);
			$statement->bindParam(":password", $password);
			$statement->execute();	
			$count=$statement->rowCount();
			return $count;	
		}
		catch(PDOException $e) 
		{
				return $e->getMessage();
		}
	}
	
	/******************
	Read UserName 
	******************/
	function usercheck($user)
	{
		global $conn;
		try
		{
			$sql = "select username from Login where `username` = :user"; 
			$statement = $conn->prepare($sql);
			$statement->bindParam(":user", $user);
			$statement->execute();	
			$result=$statement->fetch(PDO::FETCH_ASSOC);
			return $result;	
		}
		catch(PDOException $e) 
		{
				return $e->getMessage();
		}
	}

	
?>