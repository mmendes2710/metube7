<?php
session_start();
include_once "function.php";

$username=$_SESSION['username'];

if(isset($_POST['submit'])) {

	//Check for missing input from the new contact form
  if($_POST['contactName'] == "") {
    $result = "3";	//Error code that some field was missing
  }
  else {
	//Check for the new contact's username in the account table
	$contactName = $_POST['contactName'];
	$contactName = mysql_real_escape_string($contactName);
    $check = account_exists($contactName);
    if($check == 1){
      $result = "2"; //Error code if no account exists
    }
    else{
		$checkCon = contact_exists($username, $contactName);
	  if($checkCon == 1){
			$removeCon = remove_contact($username, $contactName);
			$result = "6"; //Successful contact removal
	  }
	  else{
	  	  $result = "5"; //The contact is not in the contact list
	  }
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
    <title>Contact Addition</title>
</head>
<body>
	<p>
	<?php
		$editResult = editConMess($result);
		echo "$editResult";
	?>
	</p>
	</br>
	<form action="profile.php" method="post">
			<input type="submit" class="btn" value="My Profile">
	</form>
</body>
</html>
