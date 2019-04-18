<?php
session_start();
	//echo "Session ID: ", session_id(), "<br>";
	//echo session_save_path(), "<br>";
	include_once "function.php";
	if(!isset($_SESSION['username']) || $_SESSION['username'] == ""){
		echo "Error: username variable not loaded";
	}
?>
<link rel="stylesheet" href="docs/dist/spectre.css">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Your Profile</title>
</head>
<body>
	<p>You do not have access to this media file!</p></br>
	<a href='browse.php' style="color:#FF9900;">Browse Media</a>
</body>
</html>