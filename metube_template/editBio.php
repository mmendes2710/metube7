<?php
session_start();
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
	<h3>Edit your Bio</h3>

	<?php
		$thisUser=$_SESSION['username'];
		$query = "SELECT * FROM `biographies` WHERE username = '$thisUser'"; 
		$result = mysql_query( $query );
		if (!$result)
		{
			die ("Could not query the biographies table in the database: <br />". mysql_error());
		}
	?>

	<!-- Show the current bio -->
	<div style="background:#339900;color:#FFFFFF; width:150px;">Your Bio</div>
	<table>
			<?php $result_row = mysql_fetch_row($result);?>
			<tr>
				<td>
            		<?php echo $result_row[1];?> 
				</td>
			</tr>
	</table>
	</br>

	<!-- Edit a profile bio -->
	<form method="post" action="edit_bio_process.php">
		<table width="100%">
			<tr>
				<td>Edit your bio:</td>
				<td><textarea rows="6" cols="60" name="biotext">Enter your bio information</textarea>
				</td>
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