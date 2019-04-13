<?php
session_start();
	//echo "Session ID: ", session_id(), "<br>";
	//echo session_save_path(), "<br>";
	include_once "function.php";
	if(!isset($_SESSION['username']) || $_SESSION['username'] == ""){
		echo "Error: username variable not loaded";
	}
?>
<link rel="stylesheet" href="docs/dist/spectre.css">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Your Profile</title>
</head>
<body>
	<h3>Welcome to your profile page <?php echo $_SESSION['username'];?></h3>
	<a href='browse.php' style="color:#FF9900;">Browse Media</a>

	<br/><br/>

	<?php
		if(isset($_POST['addContact'])){
			header('Location: addContact.php');
		}
	?>
	<?php
		$thisUser=$_SESSION['username'];
		$query = "SELECT * FROM `contacts` WHERE username = '$thisUser'"; 
		$result = mysql_query( $query );
		if (!$result)
		{
			die ("Could not query the contacts table in the database: <br />". mysql_error());
		}
	?>

	<!-- Show the contact list -->
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
	</table></br>

	<form action="addContact.php" method="post">
			<input type="submit" class="btn" value="Add Contact">
	</form>
	<form action="delContact.php" method="post">
			<input type="submit" class="btn" value="Remove Contact">
	</form>
	<form action="editContact.php" method="post">
			<input type="submit" class="btn" value="Edit Contact">
	</form>
	<form action="editBio.php" method="post">
			<input type="submit" class="btn" value="Edit Bio">
	</form>

	
</body>
</html>