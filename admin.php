<?php
	include('session.php');
	if(isset($_GET['goback'])) {
        header("Location: profile.php"); // Redirecting To main
    }
	//get access
	$sql = query("SELECT `Admin` FROM `Access`, `Login` WHERE `id` = `login_id` and `username`= \"$login_session\"");
	$access_row = fetch_array($sql);
	//end access save as array $access_row
	if ($access_row['Admin']) 
	{
		
	}
	else
	{
		header("Location: profile.php"); // Redirecting To main
	}
?>
<html>
    <head>
    <title>Relay</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <form action="admin.php" method="get">
            <div id="profile">
                <b id="welcome">Welcome Admin: <i><?php echo  $login_session; ?></i></b>
                <b id="logout"><a href="logout.php">Log Out</a></b>
            </div>
            <br>
			<table>
				<tr>
					<td><input type="submit" name="showusers" value="Show Users" class="inputadmin"></td>
				</tr>
				<tr>
					<td ><input type="submit" name="shownames" value="Show Relay Names" class="inputadmin"></td> 
				</tr>
				<tr>
					<td ><input type="submit" name="shownaccess" value="Show access" class="inputadmin"></td>
				</tr>
				<tr>
					<td ><input type="submit" name="goback" value="Go Back" class="inputadmin"></td> 
				</tr>
			</table>
		</form>
	</body>
<html>