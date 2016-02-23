<?php
	$showusers_active =false;
	$shownaccess_active = false;
	$shownames_active = false;
	$saved = 0;
	$msg = "";
	include('session.php');
	if(isset($_POST['goback'])) {
        header("Location: profile.php"); // Redirecting To main
    }
	if(isset($_POST['showusers'])) {
		$showusers_active =true;
		$msg = showusers_change();
    }
   
    if(isset($_POST['shownames'])) {
		$shownames_active = true;
		include("relay.php");
		$msg = showrelaynames();
    }
	if(isset($_POST['save'])) {
		$shownames_active = true;
		include("relay.php");
		$msg = showrelaynames();
		$saved = savepostrelaynames();
    }
	if(isset($_POST['saveaccess'])) {
		$shownaccess_active = true;
		include("access.php");
		$saved = savepostaccess();
    }
	
	 if(isset($_POST['shownaccess'])) {
		$shownaccess_active = true;
		$msg = showusers_access();
    }
	
	 if(isset($_POST['changepassword'])) {
		$shownaccess_active = true;
		include("passwdch.php");
		$msg = passwordchange();
    }
	
	/******************
	Check if Admin
	******************/
	$access_row = querysql("SELECT `Admin` FROM `Access`, `Login` WHERE `id` = `login_id` and `username`= \"$login_session\"");
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
<?php include("java.php"); ?>
    <title>Relay Admin</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <form name="Admin" action="admin.php" method="post">
            <div id="profile">
                <b id="welcome">Welcome Admin: <i><?php echo  $login_session; ?></i></b>
                <b id="logout"><a href="logout.php">Log Out</a></b>
            </div>
            <br>
			
			<?php 
				
				if ($shownames_active )
				{
						if ($saved == 0)
						{
							echo $msg;
							echo "<table>";
							echo "<tr>";
							echo "  <td><input type=\"submit\" name=\"save\" value=\"Save\" class=\"inputadmin\"></td>";
							echo "</tr>";
						}
						else
						{
								echo "<table>";
						}
						echo "<tr>";
						echo "  <td><input type=\"submit\" name=\"admin\" value=\"Back to Admin\" class=\"inputadmin\"></td>";
						echo "</tr>";
				}
				elseif ($showusers_active  )
					{
						if ($saved == 0)
						{
							echo $msg;		
						}
						echo "<table>";
						echo "<tr>";
						echo "  <td><input type=\"submit\" name=\"adduser\" value=\"Add User\" class=\"inputadmin\"></td>";
						echo "</tr>";
						echo "<tr>";
						echo "  <td><input type=\"submit\" name=\"deluser\" value=\"Delete User\" class=\"inputadmin\"></td>";
						echo "</tr>";
						echo "<tr>";
						echo "  <td><input type=\"submit\" name=\"admin\" value=\"Back to Admin\" class=\"inputadmin\"></td>";
						echo "</tr>";
					}
				elseif( $shownaccess_active  )
					{
						if ($saved == 0)
						{
							echo $msg;
						}
						
						echo "<table>";
						echo "<tr>";
						echo "  <td><input type=\"submit\" name=\"admin\" value=\"Back to Admin\" class=\"inputadmin\"></td>";
						echo "</tr>";
					}
					else
					{
					?>
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
						
					<?php 
					
				}
			 ?>
			 	<tr>
					<td ><input type="submit" name="goback" value="Go Back Main" class="inputadmin"></td> 
				</tr>
			</table>
		</form>
	</body>
<html>