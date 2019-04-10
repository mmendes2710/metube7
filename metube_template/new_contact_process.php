<?php
session_start();
include_once "function.php";

$username=$_SESSION['username'];

if(isset($_POST['submit'])) {

	//Check for missing input from the new contact form
  if($_POST['contactName'] == "" || $_POST['contactType'] == "") {
    $result = "3";	//Error code that some field was missing
  }
  else {

	//Check for the new contact's username in the account table
    $check = account_exists($_POST['contactName']);
    if($check == 1){
      $result = "2"; //Error code if no account exists
    }
    else{
		$checkCon = contact_exists($username, $_POST['contactName']);
	  if($checkCon == 0){
			$insertCon = register_contact($username, $_POST['contactName'], $_POST['contactType']);
			$result = "0"; //Successful contact registry
	  }
	  else{
	  	  $result = "4"; //The contact is already in the contact list.
	  }
    }
  }
}
?>

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
		$additionResult = addConMess($result);
		echo "$additionResult";
	?>
	</p>
	</br>
	<a href='profile.php' style="color:#FF9900;">Return to your Profile</a></br>
</body>
</html>



