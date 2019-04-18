<?php
session_start();
	//echo "Session ID: ", session_id(), "<br>";
	//echo session_save_path(), "<br>";
	include_once "../function.php";
	/*
	if(!isset($_POST['submit'])){
		echo "Error: username variable not loaded";
	}
	*/
	$chaName=$_POST['chaName'];
	$hideSubscribe = true;
	if(isset($_SESSION['username'])){
		//see if they already subscribed
		$username = $_SESSION['username'];
		$query1 = "SELECT COUNT(*) FROM subscriptions WHERE username='$username' and subscribeto = '$chaName'";
		$result1 = mysql_query($query1);
		$result_row1 = mysql_fetch_row($result1);
		if($result_row1[0] != 1){
			$hideSubscribe = false;
		}
	
	} 
?>
<link rel="stylesheet" href="../docs/dist/spectre.css">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $chaName?>'s Profile</title>
</head>
<body>
	<h3>Welcome to <?php echo $chaName;?>'s channel</h3>
	<a href='../index.php' style="color:#FF9900;">Browse Media</a>
	<br/><br/>
	
	<?php
		$thisUser=$_POST['chaName'];
		$query = "SELECT * FROM `contacts` WHERE username = '$thisUser'"; 
		$result = mysql_query( $query );
		if (!$result)
		{
			die ("Could not query the contacts table in the database: <br />". mysql_error());
		}
	?>
	
	</br>

	<form <?php if($hideSubscribe) echo " hidden ";?> action="../addsubscription.php" method="post">
		<input hidden name='chaName' value=<?php echo $chaName;?>>
		<input type='submit' class='btn btn-primary' value="Subscribe">
	</form>

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
	
	<!--Show the biography-->
	<?php
		$thisUser=$chaName;
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
	
	<!-- Show the media uploaded by this user -->
	<?php
		//$thisUser=$_SESSION['username'];
		$query = "SELECT upload.mediaid, media.filename, media.filepath, media.title, media.description FROM upload INNER JOIN media ON upload.mediaid = media.mediaid WHERE username = '$thisUser'";
		$muresult = mysql_query($query);
		if (!$muresult)
		{
			die ("Could not query the upload table in the database: <br />". mysql_error());
		}
	?>
	
	<div class='container'>
				<?php $title = $thisUser . "'s Media";?>
				<h3><?php echo $title; ?></h3>
				<table class="table table-striped" width="100%">
						<thead>
							<tr>
							<th>Media ID</th>
							<th>Title</th>
							<th>File Name</th>
							<th>Description</th>
							<th>Download</th>
							</tr>
						</thead>
						<tbody>
							<?php
									while($result_row = mysql_fetch_row($muresult)){
										echo "<tr>";
										echo "<td>".$result_row[0]."</td>";
										echo "<td>".$result_row[3]."</td>";
										//echo "<td>".$result_row[1]."</td>";
										echo "<td><a href='../media.php?id=".$result_row[0]."' class='btn' target='_blank'>".$result_row[1]."</a></td>";
										echo "<td>".$result_row[4]."</td>";
										echo "<td><a href='../".$result_row[2].$result_row[1]."' class='btn' download='".$result_row[2].$result_row[1]."' target='_blank' onclick='javascript:saveDownload(".$result_row[0].");'>Download</a></td>";
										echo "</tr>";
									}
							?>
					</tbody>
					</table>
	</div>
	
</body>
</html>