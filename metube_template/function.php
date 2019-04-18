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
		
		//create the default bio
		$bioDefault="Your Bio Here";
		$query = "INSERT INTO `biographies`(`username`,`biographyText`) VALUES ('$username', '$bioDefault')";
		$result = mysql_query( $query );
		if(!$result){
			die ("register_ID() failed Could not query the database: <br />". mysql_error());
		}
		
		//create the channel
		$old = umask(0);
		if(!file_exists('channels/'))
			mkdir('channels/', 0755);
		$dirfile = 'channels/';
		if(!file_exists($dirfile))
			mkdir($dirfile, 0755);
		umask($old);
		
		//copy the contents of channel.php to create the personal channel
		$channfile=$dirfile.urlencode("$username.php");
		$newChannel = fopen($channfile, "w");
		$getChannel = file_get_contents("channel.php");
		if(!getchannel){
			die ("register_ID() failed to copy channel.php contents: <br />". mysql_error());
		}
		fwrite($newChannel, $getChannel);
		fclose($newChannel);
		
		return 1;
	}
	else{
		return 0;
	}
		
}

function updateViewCount($mediaid)
{
	$query = "	update  media set viewCount = viewCount+1
   						WHERE '$mediaid' = mediaid
					";
					 // Run the query created above on the database through the connection
    $result = mysql_query( $query );
	if (!$result)
	{
	   die ("updateViewCount() failed. Could not query the database: <br />". mysql_error());
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
			die ("edit_contact() failed Could not query the database: <br />". mysql_error());
			return 1;	//Contact not registered
		}
		else{
		return 0; //Successful contact removal
		}		
}

function edit_bio($username,$biotext){
		$query = "UPDATE `biographies` SET `biographyText` = '$biotext' WHERE `username` = '$username'";
		$result = mysql_query( $query );
		if(!$result){
			die ("edit_bio() failed Could not query the database: <br />". mysql_error());
			return 1;	//Biography not updated
		}
		else{
		return 0; //Successful bio update
		}		
}



//Check if a user can view a file
function check_media_permission($mediaID, $currentUser){
		//get the media sharetype
		$notInContacts = "0";
		$query = "SELECT setting FROM sharing WHERE mediaid = '$mediaID'";
		$sresult = mysql_query($query);
		if (!$sresult)
		{
			die ("Could not query the sharing table in the database: <br />". mysql_error());
		}
		$result_row = mysql_fetch_row($sresult);
		$shareSetting = $result_row[0];
		
		//get the media's uploader username
		$query = "SELECT username FROM upload WHERE mediaid = '$mediaID'";
		$userresult = mysql_query( $query );
		if (!$userresult)
		{
			die ("Could not query the upload table in the database: <br />". mysql_error());
		}
		$result_row = mysql_fetch_row($userresult);
		$mediaUploader = $result_row[0];
		
		//find the current user on the uploader's contact list
		$query = "SELECT contactType FROM contacts WHERE contactName='$currentUser' AND username='$mediaUploader'";
		$contactResult = mysql_query( $query );
		if (!$contactResult)
		{
			$notInContacts = "1";
			//die ("Could not query the contacts table in the database: <br />". mysql_error());
		}
		$result_row = mysql_fetch_row($contactResult);
		$userStatus = $result_row[0];
		
		//Block the user if the media does not allow viewing
		if($currentUser == $mediaUploader){
			return "0";
		} else if($userStatus == "Blocked"){
			return "1";
		} else if($shareSetting == "Public"){
			return "0";
		} else if($shareSetting == $userStatus){
			return "0";
		} else if($shareSetting == "Contact" && $notInContacts == "0"){
			return "0";
		} else{
			return "1";
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

function editBioMess($result)
{
	switch ($result){
	case 0:
		return "Your bio was updated.";
	case 1:
		return "Error, your update was unsuccessful.";
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
	$comment = mysql_real_escape_string($comment);
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
	$post = mysql_real_escape_string($post);
	$query = "INSERT INTO discussion VALUES('$discussionid','$userId','$post',NOW())";
	$insert = mysql_query($query);
	if($insert == 1){
		return 1;
	}
	else{
		die("Could not query database".mysql_error());
	}
}


	
?>
