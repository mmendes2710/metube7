<?php
	session_start();
	include_once "function.php";
?>
<!--
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
-->
<link rel="stylesheet" href="docs/dist/spectre.css">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Media browse</title>
<link rel="stylesheet" type="text/css" href="css/default.css" />
<script type="text/javascript" src="js/jquery-latest.pack.js"></script>
<script type="text/javascript">
function saveDownload(id)
{
	$.post("media_download_process.php",
	{
       id: id,
	},
	function(message) 
    { }
 	);
} 
</script>
</head>

<?php
//if(!isset($_SESSION['username'])){
//	header('Refresh:0; index.php');
//}

?>
<body>
<p>Welcome <?php if(!isset($_SESSION["username"]) || $_SESSION["username"] == "") echo "Guest"; else echo $_SESSION['username'];?>
</p>

<?php
$username=$_SESSION["username"];
?>


<div class="container">
	<div class="columns">
		<div class="column col-auto">

		<form action="logout.php" method = "post">
			<input type="submit" class="btn" value="Logout">
		</form>

		<form action="update.php" method="post">
			<input type="submit" class="btn" value="Update Info">
		</form>

		<form action="message.php" method="post">
			<input type="submit" class="btn" value="Send Message">
		</form>

		<form action="inbox.php" method="post">
			<input type="submit" class="btn" value="Message Inbox">
		</form>

		<form action="profile.php" method="post">
			<input type="submit" class="btn" value="My Profile">
		</form>
		
		<form action="channels\<?php echo $username;?>.php" method="post">
			<?php $chaName = $username;?>
			<input type="radio" name="chaName" checked hidden="hidden" value="<?php echo $chaName?>">
			<input type="submit" class="btn" value="<?php echo $username;?>'s Channel">
		</form>

		<form action="playlist.php" method="post">
			<input type="submit" class="btn" value="My Playlist">
		</form>

		<form action="discussion.php" method="post">
			<input type="submit" class="btn" value="Discussion">
		</form>

		</div>
		<div class="column">
			<a href='media_upload.php'  style="color:#FF9900;">Upload File</a>
			<div id='upload_result'>
			<?php 
				if(isset($_REQUEST['result']) && $_REQUEST['result']!=0)
				{
					
					echo upload_error($_REQUEST['result']);

				}
			?>
			</div>
			<br/><br/>
			<?php

				$query = "SELECT * from media"; 
				$result = mysql_query( $query );
				if (!$result)
				{
				die ("Could not query the media table in the database: <br />". mysql_error());
				}
			?>
				
				<div style="background:#339900;color:#FFFFFF; width:150px;">Uploaded Media</div>
				<table width="50%" cellpadding="0" cellspacing="0">
					<?php
						while ($result_row = mysql_fetch_row($result))
						{ 
					?>
					<tr valign="top">			
						<td>
								<?php 
									echo $result_row[0];
								?>
						</td>
						<td>
							<a href="media.php?id=<?php echo $result_row[0];?>" target="_blank"><?php echo $result_row[1];?></a> 
						</td>
						<td>
							<a href="<?php echo $result_row[2].$result_row[1];?>" download="<?php echo $result_row[2].$result_row[1];?>" target="_blank" onclick="javascript:saveDownload(<?php echo $result_row[0];?>);">Download</a>
						</td>
					</tr>
					<?php
						}
					?>
				</table>
		</div>
	</div>
</div>
</body>
</html>
