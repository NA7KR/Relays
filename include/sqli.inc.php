<?php
	error_reporting(E_ALL);
	require("include/config.inc.php");
	
	/******************
	Connection PDO
	******************/
	function connect()
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
			return $conn;
		}
	catch(PDOException $e) 
		{
			return $e->getMessage();
		}
	}
	
	/******************
	Make SQL Call 
	******************/
	function querysql($sql) 
	{
		$conn = connect();
		try
		{
			$statement = $conn->prepare($sql);
			$statement->execute();	
			$result=$statement->fetch(PDO::FETCH_ASSOC);
			$conn = null;        // Disconnect
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
		$conn = connect();
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
			if($count != false) return $count;       // Shows the number of affected rows
			
	}
	
	/******************
	Read UserName and Password
	******************/
	function userpassword($user,$password)
	{
		$conn = connect();
		try
		{
			$sql = "SELECT * FROM Login WHERE `username` = :user AND `password` = :password"; 
			$statement = $conn->prepare($sql);
			$statement->bindParam(":user", $user);
			$statement->bindParam(":password", $password);
			$statement->execute();	
			$count=$statement->rowCount();
			$conn = null;        // Disconnect
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
		$conn = connect();
		try
		{
			$sql = "select `username`, `id` from Login where `username` = :user"; 
			$statement = $conn->prepare($sql);
			$statement->bindParam(":user", $user);
			$statement->execute();	
			$result=$statement->fetch(PDO::FETCH_ASSOC);
			$conn = null;        // Disconnect
			return $result;	
		}
		catch(PDOException $e) 
		{
				return $e->getMessage();
		}
	}
	
	/******************
	Show Access
	******************/
	function shownaccess($id)
	{
		$conn = connect();
		include("include/access.inc.php");
		try
		{
			$sql = "SELECT `Relay 1`, `Relay 2`, `Relay 3`, `Relay 4`, `Relay 5`, `Relay 6`, `Relay 7`, `Relay 8`, `Relay All`, `Admin`,`username` FROM `Access`, `Login` WHERE `id` =`login_id` and `login_id` = $id ";
			$statement = $conn->prepare($sql);
			$statement->execute();	
			
			$row = $statement->fetch(PDO::FETCH_ASSOC);
			$conn = null;        // Disconnect
			return access_row_f($row);	
		}
		catch(PDOException $e) 
		{
				return $e->getMessage();
		}
	}
	
	/******************
	Show users info
	******************/
	Function showuserinfo($id)
	{
			$conn = connect();
		include("include/user.inc.php");
		try
		{
			$sql = "SELECT `username`,`Name`,`Email` FROM `Login` WHERE `id`  = $id ";
			$statement = $conn->prepare($sql);
			$statement->execute();	
			
			$row = $statement->fetch(PDO::FETCH_ASSOC);
			$conn = null;        // Disconnect
			return user_row_f($row);	
		}
		catch(PDOException $e) 
		{
				return $e->getMessage();
		}
	}
	
	/******************
	Cehecked for checkbox
	******************/
	function checked($row)
	{
		if ($row != false)
		{
			return "CHECKED";
		}		
	}
	
	/******************
	Show Users Access
	******************/
	function showusers_access()
	{	
		$conn = connect();
		include("include/access.inc.php");
		try
		{
		$sql = "SELECT `username`, `id` FROM `Login`";
			$statement = $conn->prepare($sql);
			$statement->execute();	
			$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
			$conn = null;  			// Disconnect
			return showuser_access_rows($rows);
		}
		catch(PDOException $e) 
		{
				return $e->getMessage();
		}
	}
	
	/******************
	Show Users
	******************/
	function showusers_change()
	{	
		$conn = connect();
		include("include/user.inc.php");
		try
		{
		$sql = "SELECT `id`,`username`,`Name`,`Email` FROM `Login`";
			$statement = $conn->prepare($sql);
			$statement->execute();	
			$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
			$conn = null;  			// Disconnect
			return showuser_change_rows($rows);
		}
		catch(PDOException $e) 
		{
				return $e->getMessage();
		}
	}
	
	/******************
	Save Password 
	******************/
	function savepasswordmysql($username,$password)
	{
		$conn = connect();
		try
		 {
				$sql = "UPDATE `Login`  
				SET  
					`username` = :username, 
					`password` = :password
				WHERE `username` = '$username'";
				
				$statement = $conn->prepare($sql);
				$statement->bindValue(":username", $username);
				$statement->bindValue(":password", $password); 
				$count = $statement->execute();	
				$conn = null;        // Disconnect	
			}
			catch(PDOException $e) 
			{
				return $e->getMessage();
			}
			// If the query is succesfully performed ($count not false)
			if($count != false) return $count;       // Shows the number of affected rows
	}
	
	/******************
	Update Access 
	******************/
	function updateaccess($username,$relay1,$relay2,$relay3,$relay4,$relay5,$relay6,$relay7,$relay8,$relayall,$admin)
	{
		$conn = connect();
		try
		 {
				$sql = "UPDATE `Access`  
				SET  
					`Relay 1` = :relay1, 
					`Relay 2` = :relay2, 
					`Relay 3` = :relay3, 
					`Relay 4` = :relay4, 
					`Relay 5` = :relay5, 
					`Relay 6` = :relay6, 
					`Relay 7` = :relay7, 
					`Relay 8` = :relay8, 
					`Relay All` =:relayall,
					`Admin`		=:admin
				WHERE  `login_id` = (Select `id` From `Login` WHERE `username` = '$username')";
		
				$statement = $conn->prepare($sql);
				$statement->bindValue(":relay1", $relay1);
				$statement->bindValue(":relay2", $relay2);
				$statement->bindValue(":relay3", $relay3);
				$statement->bindValue(":relay4", $relay4);
				$statement->bindValue(":relay5", $relay5);
				$statement->bindValue(":relay6", $relay6);
				$statement->bindValue(":relay7", $relay7);
				$statement->bindValue(":relay8", $relay8); 
				$statement->bindValue(":relayall", $relayall);
				$statement->bindValue(":admin", $admin); 
				$count = $statement->execute();	
				$conn = null;        // Disconnect	
			}
			catch(PDOException $e) 
			{
				return $e->getMessage();
			}
			// If the query is succesfully performed ($count not false)
			if($count != false) return $count;       // Shows the number of affected rows
	}
	
	/******************
	Delte User 
	******************/
	function deleteusermysql($username)
	{
		$conn = connect();
		try
		 {
				$sql = "DELETE FROM `Login` WHERE `Login`.`username` = \"$username\" LIMIT 1";
					
				$statement = $conn->prepare($sql);	
				$count = $statement->execute();	
				$conn = null;        // Disconnect	
			}
			catch(PDOException $e) 
			{
				return $e->getMessage();
			}
			// If the query is succesfully performed ($count not false)
			if($count != false) return $count;       // Shows the number of affected rows
	}
	
	function insertadduser($username,$name,$email,$password)
	{	
		$conn = connect();
		try
		 {
				$sql = "INSERT INTO `Login`  
				SET  
					`username` = :username, 
					`password` = :password, 
					`Name` = :Name, 
					`Email` = :Email";
		
				$statement = $conn->prepare($sql);
				$statement->bindValue(":username", $username);
				$statement->bindValue(":password", $password); 
				$statement->bindValue(":Name", $name);
				$statement->bindValue(":Email", $email); 
				$count = $statement->execute();	
				$conn = null;        // Disconnect	
			}
			catch(PDOException $e) 
			{
				return $e->getMessage();
			}
			// If the query is succesfully performed ($count not false)
			if($count != false) return $count;       // Shows the number of affected rows	
	}
	
	/******************
	Show users info Edit User
	******************/
	Function showuserinfoedit($username)
	{
			$conn = connect();
		include("include/user.inc.php");
		try
		{
			$sql = "SELECT `id`,`username`,`Name`,`Email` FROM `Login` WHERE `username`  = \"$username\"";
			$statement = $conn->prepare($sql);
			$statement->execute();	
			
			$row = $statement->fetch(PDO::FETCH_ASSOC);
			$conn = null;        // Disconnect
			return edituserrow($row);	
		}
		catch(PDOException $e) 
		{
				return $e->getMessage();
		}
	}
	
	/******************
	Save users info Edit User
	******************/
	function editusersaved($id,$username,$name,$email)
	{
		$conn = connect();
		try
		 {
				$sql = "UPDATE `Login`  
				SET   
					`username` = :username, 
					`Name` = :Name, 
					`Email` =:Email
				WHERE `id` = '$id'";
		
				$statement = $conn->prepare($sql);
				$statement->bindValue(":username", $username); 
				$statement->bindValue(":Name", $name);
				$statement->bindValue(":Email", $email); 
				$count = $statement->execute();	
				$conn = null;        // Disconnect	
			}
			catch(PDOException $e) 
			{
				return $e->getMessage();
			}
			// If the query is succesfully performed ($count not false)
			if($count != false) return $count;       // Shows the number of affected rows
	}
?>