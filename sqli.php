<?php
	/******************
	Make SQL Call 
	******************/
	function query($sql) {
		global $connection;
		$result = mysqli_query($connection, $sql) or die();
		return $result;
	}

	/******************
	Get SQL Num Rows
	******************/
	function get_num_rows($sql){
		$num = mysqli_num_rows($sql);  
		return $num;
	}

	/******************
	Fetch SQL Array
	******************/
	function fetch_array($sql , $optional=''){
		if($optional != ''){
			$fetch = mysqli_fetch_array($sql , $optional); //2nd optional param = MYSQLI_ASSOC (mysqli_fetch_assoc()) or MYSQLI_NUM (mysqli_fetch_row())  or MYSQLI_BOTH (returns single array with features of the other two) 
		}else{
			$fetch = mysqli_fetch_array($sql);       
		}
		return $fetch;
	}
?>