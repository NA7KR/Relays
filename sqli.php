<?php
	error_reporting(E_ALL);
	require("config.php");
	
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
			$sql = "select username from Login where `username` = :user"; 
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
	function shownaccess()
	{
		$conn = connect();
		try
		{
			$sql = "SELECT `Relay 1`, `Relay 2`, `Relay 3`, `Relay 4`, `Relay 5`, `Relay 6`, `Relay 7`, `Relay 8`, `Relay All`, `Admin`,`username` FROM `Access`, `Login` WHERE `id` = `login_id` ";
			$statement = $conn->prepare($sql);
			$statement->execute();	
			$msg  =  "<table>";
			$msg .=  "<tr>";
				$msg .= "<td>User Name</td>";
				$msg .= "<td>Relay 1</td>";
				$msg .= "<td>Relay 2</td>";
				$msg .= "<td>Relay 3</td>";
				$msg .= "<td>Relay 4</td>";
				$msg .= "<td>Relay 5</td>";
				$msg .= "<td>Relay 6</td>";
				$msg .= "<td>Relay 7</td>";
				$msg .= "<td>Relay 8</td>";
				$msg .= "<td>Relay All</td>";
				$msg .= "<td>Admin</td>";
				$msg  .=  "	</tr>";
			$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
			foreach($rows as $access_row) : 
				$msg .=  "<tr>";
				$msg .= "<td><input type=\"text\" name=\"username\" value=\"" . $access_row['username'] . "\"   ></td>\n";
				$msg .= "<td><input type=\"text\" name=\"relay1\" value=\"" . $access_row['Relay 1'] . "\"   class=\"relay\" ></td>\n";
				$msg .= "<td><input type=\"text\" name=\"relay2\" value=\"" . $access_row['Relay 2'] . "\"   class=\"relay\"  ></td>\n";
				$msg .= "<td><input type=\"text\" name=\"relay3\" value=\"" . $access_row['Relay 3'] . "\"   class=\"relay\" ></td>\n";
				$msg .= "<td><input type=\"text\" name=\"relay4\" value=\"" . $access_row['Relay 4'] . "\"   class=\"relay\" ></td>\n";
				$msg .= "<td><input type=\"text\" name=\"relay5\" value=\"" . $access_row['Relay 5'] . "\"   class=\"relay\" ></td>\n";
				$msg .= "<td><input type=\"text\" name=\"relay6\" value=\"" . $access_row['Relay 6'] . "\"   class=\"relay\" ></td>\n";
				$msg .= "<td><input type=\"text\" name=\"relay7\" value=\"" . $access_row['Relay 7'] . "\"   class=\"relay\" ></td>\n";
				$msg .= "<td><input type=\"text\" name=\"relay8\" value=\"" . $access_row['Relay 8'] . "\"   class=\"relay\" ></td>\n";
				$msg .= "<td><input type=\"text\" name=\"relay9\" value=\"" . $access_row['Relay All'] . "\" class=\"relay\" ></td>\n";
				$msg .= "<td><input type=\"text\" name=\"relay10\" value=\"" . $access_row['Admin'] . "\" 	 class=\"relay\" ></td>\n";
				$msg  .=  "	</tr>";
			endforeach;
			$msg  .=  "	</table>";
			$conn = null;        // Disconnect
			return $msg;	
		}
		catch(PDOException $e) 
		{
				return $e->getMessage();
		}
	}
	
	/******************
	Show Users
	******************/
	function showusers()
	{	
		$conn = connect();
		try
		{
			$sql = "SELECT `username` FROM `Login`";
			$statement = $conn->prepare($sql);
			$statement->execute();	
			$msg  =  "<table>";
			$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
			foreach($rows as $access_row) : 
				$msg .=  "<tr>";
				$msg .= "<td>" . $access_row['username'] ."</td>";
				$msg  .=  "	</tr>";
			endforeach;
			$msg  .=  "	</table>";
			$conn = null;        // Disconnect
			return $msg;	
		}
		catch(PDOException $e) 
		{
				return $e->getMessage();
		}
	}
?>