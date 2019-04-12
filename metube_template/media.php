<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	session_start();
	include_once "function.php";
?>	
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="stylesheet" href="docs/dist/spectre.css">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Media</title>
<script src="Scripts/AC_ActiveX.js" type="text/javascript"></script>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>

<body>
<?php
if(isset($_GET['submit'])){
	if($_GET['comment'] != ""){
		$result = send_comment($_GET['id'],$_SESSION['username'],$_GET['comment']);
		if($result == 1){
		}
		else{
			echo "<script>alert('Unable to post comment')</script>";  
		}
	}
}
if(isset($_GET['id'])) {
	$id = $_GET['id'];
	$query = "SELECT * FROM media WHERE mediaid='".$_GET['id']."'";
	$result = mysql_query( $query );
	$result_row = mysql_fetch_row($result);
	
	updateMediaTime($_GET['id']);
	
	$filename=$result_row[1];
	$filepath=$result_row[2];
	$type=$result_row[3];
	if(substr($type,0,5)=="image") //view image
	{
		echo "Viewing Picture:";
		echo $result_row[2].$result_row[1];
		echo "<img src='".$filepath.$filename."'/>";
	}
	else //view movie
	{	
?>
	<p>Viewing Video:<?php echo $result_row[2].$result_row[1];?></p>
	<video width="320" height="240" autoplay>
		<source src=<?php echo $result_row[2].$result_row[1];?>>	
	</video>


    <!-- <object id="MediaPlayer" width=320 height=286 classid="CLSID:22D6f312-B0F6-11D0-94AB-0080C74C7E95" standby="Loading Windows Media Player components…" type="application/x-oleobject" codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,4,7,1112">
	

<param name="filename" value="<?php echo $result_row[2].$result_row[1];  ?>">
<param name="Showcontrols" value="True">
<param name="autoStart" value="True">

<embed type="application/x-mplayer2" src="<?php echo $result_row[2].$result_row[1];  ?>" name="MediaPlayer" width=320 height=240></embed>

</object> -->         
<?php
	}
}
else
{
?>
<!-- <meta http-equiv="refresh" content="0;url=browse.php"> -->
<?php
}
?>
<form action="media.php" method="get">
	<label class="form-label" for="input-example-1">Comment on video</label>
	<input hidden name ="id" value=<?php echo $id;?>>
	<input class="form-input" style="width: 300px" type="text" name="comment" placeholder="Write comment here...">
	<input name="submit" type="submit"class="btn" value="Submit Comment">
</form>
<?php 
	$query2 = "SELECT * FROM comments WHERE mediaid ='".$_GET['id']."' ORDER BY time DESC";
	$result2 = mysql_query($query2);
?>
<div class="container">
    <h3>Comments: </h3>
        <table class="table" width="100%">
            <thead>
                <tr>
                <th>User</th>
                <th>Comment</th>
                <th>Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($result_row = mysql_fetch_row($result2)){
                        $user = $result_row[1];
                        $comment = $result_row[2];
                        $time = $result_row[3];

                        echo "<tr>";
                        echo "<td>".$user."</td>";
                        echo "<td>".$comment."</td>";
                        echo "<td>".$time."</td>";
                        echo "</tr>";
                    }
                ?>
         </tbody>
        </table>
    </div>

</body>
</html>
