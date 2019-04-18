 <?php
	session_start();
	include_once "function.php";
	if(!isset($_SESSION['username'])){
    	header('Location: index.php');
    }
 
	$mediaid=$_POST['id'];
 ?>
 
 <link rel="stylesheet" href="docs/dist/spectre.css">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Upload</title>
</head>

<body>
 <!-- Add a new contact to the user's contact list' -->
	<form method="post" action="edit_upload_process.php" enctype="multipart/form-data">
		<table width="100%">
			<tr>
				<td  width="20%">Title:</td>
				<td width="80%"><input class="text" type="text" name="title"><br/></td>
			</tr>
			<tr>
				<td>Description:</td>
				<td><textarea rows="6" cols="60" name="description">Enter a description for your video</textarea>
				</td>
			</tr>
			<tr>
				<td  width="20%">Select a category:</td>
				<td>
					<select name="category">
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
				</td>
			</tr>
			<tr>
			<tr>
				<td>Allow this video or picture to be rated?</td>
				<td>
				<input type="radio" name="allowRating" value="1" checked>Yes<br>
				<input type="radio" name="allowRating" value="0"> No<br> 
				</td>
			</tr>
			<tr>
			<br>
				<td>Allow commenting for this video?</td>
				<td>
				<input type="radio" name="allowDisc" value="1" checked> Yes<br>
				<input type="radio" name="allowDisc" value="0"> No<br> 
				</td>
			</tr>
			<tr><td><br>Add up to 5 keywords for this video. You can edit them in your channel (only lowercase is allowed):</br></td></tr>
			<tr><td><input style="text-transform: lowercase;" type="text" name="keyword[]"></td></tr>
			<tr><td><input style="text-transform: lowercase;" type="text" name="keyword[]"></td></tr>
			<tr><td><input style="text-transform: lowercase;" type="text" name="keyword[]"></td></tr>
			<tr><td><input style="text-transform: lowercase;" type="text" name="keyword[]"></td></tr>
			<tr><td><input style="text-transform: lowercase;" type="text" name="keyword[]"></td></tr>
			<tr>
				<td  width="20%">Select the sharing settings (only people in that list will be able to view it):</td>
				<td>
					<select name="sharing">
						<option value="Public" selected hidden="hidden">Choose here</option>
						<option value="Public">Public</option>
						<option value="Private">Private</option>
						<option value="Friend">Friends</option>
						<option value="Family">Family</option>
						<option value="Foe">Foes</option>
						<option value="Favorite">Favorites</option>
						<option value="Contact">Contacts</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<input name = "submit" type="submit" class="btn" value="Submit Edit">
				</td>
			</tr>
		</table>
		<input hidden name ='id' value="<?php echo $mediaid?>">
	</form>

</body>
</html>