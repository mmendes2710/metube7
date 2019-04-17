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
	$username = $_SESSION['username'];
	$query1 = "SELECT media.mediaid, media.filename, media.filepath, media.title, media.description FROM media ORDER BY mediaid DESC";
    $bquery = $query1;
    $title = "Browse";

    if(isset($_POST['category']) && $_POST['category'] != ""){
        $category = $_POST['category'];
        $query2 = "SELECT media.mediaid, media.filename, media.filepath, media.title, media.description  FROM media WHERE category='$category' ORDER BY mediaid DESC";
        $bquery = $query2;
        $title = "Category: ".$category;
    }
    else if(isset($_POST['search']) && $_POST['search'] != ""){
        $keyword=$_POST['search'];
        $query3 = "SELECT media.mediaid, media.filename, media.filepath, media.title, media.description FROM `keywords` INNER JOIN media on keywords.mediaid = media.mediaid WHERE keyword='$keyword'  ORDER BY mediaid DESC";
        $bquery = $query3;
        $title = "Keyword Search on '".$keyword."'";
    }

    $bresult = mysql_query($bquery);
	
?>

<p>Welcome <?php if(!isset($_SESSION["username"])) echo "N?A"; else echo $_SESSION['username'];?>
</p>


<div class="container">
	<div class="columns">
		<div class="column col-auto">

		<form action="logout.php" method = "post">
			<input type="submit" class="btn" value="Logout">
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
		
		<form action="favorites.php" method="post">
			<input type="submit" class="btn" value="My Favorites">
		</form>
		
		<form action="discussion.php" method="post">
			<input type="submit" class="btn" value="Discussion">
		</form>

		</div>
		<div class="column">
			<a href='media_upload.php' class="btn btn-primary" >Upload File</a>
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
    			$query = @mysql_query("SELECT * FROM account");
			?>

			<form action="browse.php" method="post">
				<div class="columns">
					<div class="column col-auto">
						<?php 
							echo "<h5> Channel Listings: </h5>";
						?>
					</div>
					<div class="column col-auto">
						<?php
							echo "<select class='form-select' style='width: 300px' name='listingdropdown'>";
							echo "<option></option>";
							while($row = mysql_fetch_array($query)){
								echo "<option value='".$row[0]."'>".$row[0]."</option>";
							}
							echo "</select>";
						?>
					</div>
					<div class="column col-auto">
						<input type="submit" class="btn" name="submit" VALUE="Submit" style="width: 200px">
					</div>
				</div>
			</form>
			<form action="browse.php" method="post">
				<div class="container">
					<div class ="columns">
						<div class="column col-auto">
							<h5>Search Metube: </h5>
						</div>
						<div class="column col-auto">
							<input type="text" class="form-input" name="search" style="width:300px" placeholder="Keyword Search...";>
						</div>
						<div class="column col-auto">
							<input type="submit" class="btn" VALUE="Search" style="width: 200px">
						</div>
					</div>
				</div>
			</form>
			<form action="browse.php" method="post">
				<div class="container">
					<div class ="columns">
						<div class="column col-auto">
							<h5>Category: </h5>
						</div>
						<div class="column col-auto">
						<select name="category" id="category" class="form-select">
									<option></option>
									<option value="Miscellaneous" selected hidden="hidden">Choose here</option>
									<option value="Auto and Vehicles">Auto and Vehicles</option>
									<option value="Beauty and Fashion">Beauty and Fashion</option>
									<option value="Comedy">Comedy</option>
									<option value="Education">Education</option>
									<option value="Entertainment">Entertainment</option>
									<option value="Family Entertainment">Family Entertainment</option>
									<option value="Film and Animation">Film and Animation</option>
									<option value="Food">Food</option>
									<option value="Gaming">Gaming</option>
									<option value="How-to and Style">How-to and Style</option>
									<option value="Music">Music</option>
									<option value="News and Politics">News and Politics</option>
									<option value="Nonprofits and Activism">Nonprofits and Activism</option>
									<option value="People and Blogs">People and Blogs</option>
									<option value="Pets and Animals">Pets and Animals</option>
									<option value="Science and Technology">Science and Technology</option>
									<option value="Sports">Sports</option>
									<option value="Travel and Events">Travel and Events</option>
									<option value="Miscellaneous">Miscellaneous</option>
								</select>
						</div>
						<div class="column col-auto">
							<input type="submit" class="btn" VALUE="Search" style="width: 200px">
						</div>
					</div>
				</div>
			</form>
			<div class="container">
			<div class="columns">
				<div class="column col-auto">
					<form action="browse.php" method="post">
						<input type="submit" class="btn" name="mostRecent" VALUE="Most Recent Uploads" style="width: 200px">
					</form>
				</div>
				<div class="column col-auto">
				<form action="cloudresults.php" method="post">
						<input type="submit" class="btn" name="mostRecent" VALUE="Word Cloud" style="width: 200px">
					</form>
				</div>
			</div>
			</div>
			
			<div class='container'>
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
									while($result_row = mysql_fetch_row($bresult)){
										echo "<tr>";
										echo "<td>".$result_row[0]."</td>";
										echo "<td>".$result_row[3]."</td>";
										//echo "<td>".$result_row[1]."</td>";
										echo "<td><a href='media.php?id=".$result_row[0]."' class='btn' target='_blank'>".$result_row[1]."</a></td>";
										echo "<td>".$result_row[4]."</td>";
										echo "<td><a href='".$result_row[2].$result_row[1]."' class='btn' download='".$result_row[2].$result_row[1]."' target='_blank' onclick='javascript:saveDownload(".$result_row[0].");'>Download</a></td>";
										echo "</tr>";
									}
							?>
					</tbody>
					</table>
			</div>
				
		</div>
	</div>
</div>
</body>
</html>
