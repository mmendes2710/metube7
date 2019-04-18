<?php
	session_start();
	include_once "function.php";
	if(!isset($_SESSION['username'])){
    	header('Location: index.php');
    }
	
$username=$_SESSION['username'];
$title=$_POST['title'];
$description=$_POST['description'];
$category=$_POST['category'];
$allowDisc=$_POST['allowDisc'];
$allowRating=$_POST['allowRating'];
$share=$_POST['sharing'];
$mediaid=$_POST['id'];
$keyword = $_POST['keyword'];

	if(isset($mediaid)){
		//Check for missing mediaid
		if($mediaid == "") {
			$editResult = "3";	//Error code that some field was missing
		} 
		else {
			$editMeta = editUpload($mediaid, $title, $description, $category, $allowDisc, $allowRating, $share, $keyword);
			if($editMeta == 0){
				$editResult="6"; //Successful metadata edit
			}
			else{
				$editResult="5"; //Error in editing metadata
			}
		}
	}
 ?>
 
 <link rel="stylesheet" href="docs/dist/spectre.css">
<!--Display contact addition or error and return to the profile page-->
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Edit a file file</title>
</head>
<body>
	<p>
	<?php
		echo $mediaid;
		echo $title;
		$editResult = editUploadMess($editResult);
		echo "$editResult";
	?>
	</p>
	</br>
	<form action="profile.php" method="post">
			<input type="submit" class="btn" value="My Profile">
	</form>
</body>

</html>