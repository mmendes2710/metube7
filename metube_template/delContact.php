﻿<?php
session_start();
	//echo "Session ID: ", session_id(), "<br>";
	//echo session_save_path(), "<br>";
	include_once "function.php";
	if(!isset($_SESSION['username']) || $_SESSION['username'] == ""){
		echo "Error: username variable not loaded";
	}
?>
<link rel="stylesheet" href="docs/dist/spectre.css">
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title></title>
</head>
<body>
	<h3>Remove a Contact</h3>

	<?php
		$thisUser=$_SESSION['username'];
		$query = "SELECT * FROM `contacts` WHERE username = '$thisUser'"; 
		$result = mysql_query( $query );
		if (!$result)
		{
			die ("Could not query the contacts table in the database: <br />". mysql_error());
		}
	?>


	<div style="background:#339900;color:#FFFFFF; width:150px;">Contact List</div>
	<table width="50%" cellpadding="0" cellspacing="0">
		<?php
			while ($result_row = mysql_fetch_row($result))
			{ 
		?>
			<tr valign="top">
			
				<td>
            		<?php echo $result_row[1];?> 
				</td>
				<td>
            		<?php echo $result_row[2];?>
				</td>
			</tr>
        <?php
			}
		?>
	</table>
	</br>

	<!-- Remove a contact from the user's list' -->
	<form method="post" action="rem_contact_process.php">
		<table width="100%">
			<tr>
				<td  width="20%">Contact Username to remove:</td>
				<td width="80%"><input class="text"  type="text" name="contactName"><br/></td>
			</tr>
			<tr>
				<td>
					<input name = "submit" type="submit" class="btn" value="Submit">
				</td>
			</tr>
		</table>
	</form>
	</br>
	<form action="profile.php" method="post">
			<input type="submit" class="btn" value="My Profile">
	</form>
</body>
</html>