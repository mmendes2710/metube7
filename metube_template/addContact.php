﻿<?php
session_start();
	echo "Session ID: ", session_id(), "<br>";
	echo session_save_path(), "<br>";
	include_once "function.php";
	if(!isset($_SESSION['username']) || $_SESSION['username'] == ""){
		echo "Error: username variable not loaded";
	}
?>
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title></title>
</head>
<body>
	<h3>Add a new contact</h3>

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

	<!-- Add a new contact to the user's contact list' -->
	<form method="post" action="<?php echo "new_contact_process.php"; ?>">
		<table width="100%">
			<tr>
				<td  width="20%">New Contact Username:</td>
				<td width="80%"><input class="text"  type="text" name="contactName"><br/></td>
			</tr>
			<tr>
				<td  width="20%">Select new contact type:</td>
				<td>
					<select name="contactType">
						<option value="Contact" selected hidden="hidden">Choose here</option>
						<option value="Contact">Contact</option>
						<option value="Friend">Friend</option>
						<option value="Foe">Foe</option>
						<option value="Family">Family</option>
						<option value="Favorite">Favorite</option>
						<option value="Blocked">Blocked</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><input type="submit" value="Submit" name="submit"></td>
			</tr>
		</table>
	</form>
	</br>
	<a href='profile.php' style="color:#FF9900;">Return to your Profile</a></br>
</body>
</html>