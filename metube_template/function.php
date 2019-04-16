<?php
include "mysqlClass.inc.php";

function user_pass_check($username, $password)
{
	
	$query = "select * from account where username='$username'";
	$result = @mysql_query( $query );
		
	if (!$result)
	{
	   die ("user_pass_check() failed. Could not query the database: <br />". mysql_error());
	}
	else{
		$row = mysql_fetch_row($result);

		if($row == 0) return 1;
		
		if(strcmp($row[1],$password))
			return 2; //wrong password
		else 
			return 0; //Checked.
	}	
}

function register_ID($username,$password,$email,$type){
	$query = "select count(*) from account where username='$username'";
	$result = mysql_query( $query );
	if(!$result){
		die ("register_ID() failed Could not query the database: <br />". mysql_error());
	}
	$row = mysql_fetch_row($result);
	
	if ($row[0] == 0)
	{
		$query = "INSERT INTO `account`(`username`, `password`, `email`, `type`) VALUES ('$username','$password','$email','$type')";
		$result = mysql_query( $query );
		if(!$result){
			die ("register_ID() failed Could not query the database: <br />". mysql_error());
		}
		return 1;
	}
	else{
		return 0;
	}
		
}

function updateMediaTime($mediaid)
{
	$query = "	update  media set lastaccesstime=NOW()
   						WHERE '$mediaid' = mediaid
					";
					 // Run the query created above on the database through the connection
    $result = mysql_query( $query );
	if (!$result)
	{
	   die ("updateMediaTime() failed. Could not query the database: <br />". mysql_error());
	}
}

function upload_error($result)
{
	//view error description in http://us2.php.net/manual/en/features.file-upload.errors.php
	switch ($result){
	case 1:
		return "UPLOAD_ERR_INI_SIZE";
	case 2:
		return "UPLOAD_ERR_FORM_SIZE";
	case 3:
		return "UPLOAD_ERR_PARTIAL";
	case 4:
		return "UPLOAD_ERR_NO_FILE";
	case 5:
		return "File has already been uploaded";
	case 6:
		return  "Failed to move file from temporary directory";
	case 7:
		return  "Upload file failed";
	}
}

function account_exists($username)
{
	$query = "select count(*) from account where username='$username'";
	$result = mysql_query( $query );
	if(!$result){
		die ("register_ID() failed Could not query the database: <br />". mysql_error());
	}
	$row = mysql_fetch_row($result);
	
	if ($row[0] == 0)
	{
		return 1; //The account does not exist
	}
	else{
		return 0; //The contact exists
	}
}

function contact_exists($username, $contactName)
{
	$query = "select count(*) from contacts where username='$username' AND contactName='$contactName'";
	$result = mysql_query( $query );
	if(!$result){
		die ("register_ID() failed Could not query the database: <br />". mysql_error());
	}
	$row = mysql_fetch_row($result);
	
	if ($row[0] == 0)
	{
		return 0; //The contact is not in the contacts list
	}
	else{
		return 1; //The contact is in the contacts list
	}
}

function register_contact($username,$contactName,$contactType){
		$query = "INSERT INTO `contacts`(`username`, `contactName`, `contactType`) VALUES ('$username','$contactName','$contactType')";
		$result = mysql_query( $query );
		if(!$result){
			die ("register_ID() failed Could not query the database: <br />". mysql_error());
			return 1;	//Contact not registered
		}
		else{
		return 0; //Successful contact registry
		}		
}

function remove_contact($username,$contactName){
		$query = "DELETE FROM `contacts` WHERE `username` = '$username' AND `contactName` = '$contactName'";
		$result = mysql_query( $query );
		if(!$result){
			die ("register_ID() failed Could not query the database: <br />". mysql_error());
			return 1;	//Contact not registered
		}
		else{
		return 0; //Successful contact removal
		}		
}

function edit_contact($username,$contactName,$contactType){
		$query = "UPDATE `contacts` SET `contactType` = '$contactType' WHERE `username` = '$username' AND `contactName` = '$contactName'";
		$result = mysql_query( $query );
		if(!$result){
			die ("register_ID() failed Could not query the database: <br />". mysql_error());
			return 1;	//Contact not registered
		}
		else{
		return 0; //Successful contact removal
		}		
}

//Displays the result of an attempted contact addition	
function editConMess($result)
{
	switch ($result){
	case 0:
		return "The contact was added to your list!";
	case 2:
		return "There is no account for that username";
	case 3:
		return "Missing some input";
	case 4:
		return "This contact is already in your list!";
	case 5:
		return "This contact is not in your contact list.";
	case 6:
		return "This contact was successfully removed.";
	case 7:
		return "This contact was edited.";
	}
}
function other()
{
	//You can write your own functions here.
}

function send_message($to,$from,$message){
	$query = "INSERT INTO messages VALUES('$to','$from','$message',NOW())";
	$insert = mysql_query($query);
	if($insert == 1){
		return 1;
	}
	else{
		die("Could not query database".mysql_error());
	}
}
function send_comment($mediaId, $userId, $comment){
	$query = "INSERT INTO comments VALUES('$mediaId','$userId','$comment',NOW())";
	$insert = mysql_query($query);
	if($insert == 1){
		return 1;
	}
	else{
		die("Could not query database".mysql_error());
	}
}
function send_discussion($discussionid, $userId, $post){
	$query = "INSERT INTO dicussion VALUES('$discussionid','$userId','$post',NOW())";
	$insert = mysql_query($query);
	if($insert == 1){
		return 1;
	}
	else{
		die("Could not query database".mysql_error());
	}
}


	
?>
