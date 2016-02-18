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
		$msg = showusers();
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
		$shownames_active = true;
		$msg = shownaccess();
		include("access.php");
		$saved = savepostaccess();
    }
	

	
	 if(isset($_POST['shownaccess'])) {
		$shownaccess_active = true;
		$msg = shownaccess();
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
	<script>
	function showUser(str) {
		if (str == "") {
			document.getElementById("txtHint").innerHTML = "";
			return;
		 } else { 
			if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			} else {
				// code for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			 }
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
				 }
			};
			xmlhttp.open("GET","getuser.php?q="+str,true);
			xmlhttp.send();
		}
	}
	</script>
    <title>Relay Admin</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <form action="admin.php" method="post">
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
							
							echo "<table>";
							echo "<tr>";
							echo "  <td><input type=\"submit\" name=\"changepassword\" value=\"Change Password\" class=\"inputadmin\"></td>";
							echo "</tr>";
						}
						else
						{
								echo "<table>";
						}
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
							echo "<table>";
							echo "<tr>";
							echo "  <td><input type=\"submit\" name=\"saveaccess\" value=\"Save Access\" class=\"inputadmin\"></td>";
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