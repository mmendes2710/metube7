<?php
session_start();
?>

<link rel="stylesheet" href="docs/dist/spectre.css">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Media Upload</title>
</head>

<body>
<!--
<form method="post" action="media_upload_process.php" enctype="multipart/form-data" >

  <p style="margin:0; padding:0">
  <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
   Add a Media: <label style="color:#663399"><em> (Each file limit 10M)</em></label><br/>
   <input  name="file" type="file" size="50" />
  
	<input value="Upload" name="submit" type="submit" />
  </p>   
</form>
//-->

 <!-- Add a new contact to the user's contact list' -->
	<form method="post" action="media_upload_process.php" enctype="multipart/form-data">
		<table width="100%">
			<tr>
				<input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
				Add a Media: <label style="color:#663399"><em> (Each file limit 10M)</em></label><br/>
				<input  name="file" type="file" size="50" />
			</tr>
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
				<input type="radio" name="allowRating" value="1" checked> Yes<br>
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
				<td>
					<input name = "submit" type="submit" class="btn" value="Upload">
				</td>
			</tr>
		</table>
	</form>

</body>
</html>
