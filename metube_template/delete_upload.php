<?php
session_start();
include_once "function.php";
?>


<link rel="stylesheet" href="docs/dist/spectre.css">
<!--Display contact addition or error and return to the profile page-->
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Remove a file</title>
</head>
<body>
	<p>
	<?php
	
	$mediaid=$_POST['id'];
	if(isset($mediaid)){
		//Check for missing mediaid
		if($mediaid == "") {
			$delResult = "3";	//Error code that some field was missing
		} 
		else {
			$removeFile = deleteUpload($mediaid);
			if($removeFile == 0){
				$delResult="6"; //Successful file removal
			}
			else{
				$delResult="5"; //Error removing file
			}
		}
	}
		$editResult = deleteUploadMess($delResult);
		echo "$editResult";
	?>
	</p>
	</br>
	<form action="profile.php" method="post">
			<input type="submit" class="btn" value="My Profile">
	</form>
</body>

</html>