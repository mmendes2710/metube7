<?php
session_start();
include_once "function.php";

$username=$_SESSION['username'];

if(isset($_POST['submit'])) {
	$editBio = edit_bio($username, $_POST['biotext']);
/*
	//Check for missing input from the contact form
  if($_POST['contactName'] == "" || $_POST['contactType'] == "") {
    $result = "3";	//Error code that some field was missing
  }
  else {

	//Check for the contact's username in the account table
    $check = account_exists($_POST['contactName']);
    if($check == 1){
      $result = "2"; //Error code if no account exists
    }
    else{
		$checkCon = contact_exists($username, $_POST['contactName']);
	  if($checkCon == 1){
			$editCon = edit_contact($username, $_POST['contactName'], $_POST['contactType']);
			$result = "7"; //Successful contact edit
	  }
	  else{
	  	  $result = "5"; //The contact is not in the contact list.
	  }
    }
  }
  */
}
?>

<link rel="stylesheet" href="docs/dist/spectre.css">
<!--Display contact addition or error and return to the profile page-->
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Contact Addition</title>
</head>
<body>
	<p>
	<?php
		$editResult = editBioMess($editBio);
		echo "$editResult";
	?>
	</p>
	</br>
	<form action="profile.php" method="post">
			<input type="submit" class="btn" value="My Profile">
	</form>
</body>
</html>