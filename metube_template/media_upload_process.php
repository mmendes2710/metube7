<?php
session_start();
include_once "function.php";

/******************************************************
*
* upload document from user
*
*******************************************************/

$username=$_SESSION['username'];
$title=$_POST['title'];
$description=$_POST['description'];
$category=$_POST['category'];
$allowDisc=$_POST['allowDisc'];
$allowRating=$_POST['allowRating'];

//Create Directory if doesn't exist
$old = umask(0);
if(!file_exists('uploads/'))
	mkdir('uploads/', 0755);
$dirfile = 'uploads/'.$username.'/';
if(!file_exists($dirfile))
	mkdir($dirfile, 0755);
umask($old);

	if($_FILES["file"]["error"] > 0 )
	{ $result=$_FILES["file"]["error"];} //error from 1-4
	else
	{
	  $upfile = $dirfile.urlencode($_FILES["file"]["name"]);
	  
	  if(file_exists($upfile))
	  {
	  		$result="5"; //The file has been uploaded.
	  }
	  else{
			if(is_uploaded_file($_FILES["file"]["tmp_name"]))
			{
				if(!move_uploaded_file($_FILES["file"]["tmp_name"],$upfile))
				{
					$result="6"; //Failed to move file from temporary directory
				}
				else /*Successfully upload file*/
				{
					$old = umask(0);
					chmod($upfile, 0755);
					umask($old);
					//insert into media table
					$insert = "insert into media(
							  mediaid, filename,filepath,type,title,description,allowRate,allowDisc,size,category)".
							  "values(NULL,'". urlencode($_FILES["file"]["name"])."','$dirfile','".$_FILES["file"]["type"]."','$title','$description','$allowRating','$allowDisc','".$_FILES["file"]["size"]."','$category')";
					$queryresult = mysql_query($insert)
						  or die("Insert into Media error in media_upload_process.php " .mysql_error());
					$result="0";
					
					//insert keywords to the keyword table
					$fileName=$_FILES["file"]["name"];
					foreach($_POST['keyword'] as $word){
					if($word == ""){
						continue;
					}
					$getMediaID = "SELECT mediaid FROM media WHERE filename='$fileName'";
					$currentMediaRow= mysql_query($getMediaID)
						or die("Could not retrieve mediaid in media_upload_process.php " .mysql_error());
					$result_row=mysql_fetch_row($currentMediaRow);
					$insertKey = "insert into keywords(
							  keyword,mediaid,keyMediaID)".
							  "values('$word','$result_row[0]', NULL)";
					$queryresult = mysql_query($insertKey)
						  or die("Insert into Keywords error in media_upload_process.php " .mysql_error());
					$result="0";
					}
					
					$mediaid = mysql_insert_id();
					//insert into upload table
					$insertUpload="insert into upload(uploadid,username,mediaid) values(NULL,'$username','$mediaid')";
					$queryresult = mysql_query($insertUpload)
						  or die("Insert into view error in media_upload_process.php " .mysql_error());
				}
			}
			else  
			{
					$result="7"; //upload file failed
			}
		}
	}
	
	//You can process the error code of the $result here.
?>
<!--
<!DOCTYPE html>
<html>
<body>

<h1>Upload result</h1>
<a href='browse.php' style="color:#FF9900;">Browse Media</a>
<p>My first paragraph.</p>

</body>
</html>
-->
<meta http-equiv="refresh" content="0;url=browse.php?result=<?php echo $result;?>">
