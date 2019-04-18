<?php

    session_start();
    include_once "function.php";
	
	$channelName = $_POST['listingdropdown'];
	$fullURL = $channelName.".php";
	
?>
<link rel="stylesheet" href="docs/dist/spectre.css">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Send to a Channel</title>
</head>
<body>
	<form action="channels/<?php echo $fullURL?>" method="post">
			<input type="radio" name="chaName" value="<?php echo $channelName?>" hidden= "hidden" checked><br>
			<input type="submit" class="btn" value="Continue to Channel">
	</form>
</body>
</html>