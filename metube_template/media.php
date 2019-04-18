<!DOCTYPE html>
<?php
	session_start();
	include_once "function.php";

?>	
<html>
<link rel="stylesheet" href="docs/dist/spectre.css">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Media</title>
<script src="Scripts/AC_ActiveX.js" type="text/javascript"></script>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>
<form action="browse.php" method="post">
	<input type='submit' class='btn btn-primary' value="HOME">
</form>

<body>

<div class="columns">
<div class="column col-8">

<?php
if(isset($_GET['submit'])){
	if($_GET['comment'] != ""){
		$result = send_comment($_GET['id'],$_SESSION['username'],$_GET['comment']);
		if($result == 1){
		}
		else{
			echo "<script>alert('Unable to post comment')</script>";  
		}
		$id = $_GET['id'];
		header("Location: media.php?id=$id");
	}
}
if(isset($_GET['id'])) {
	$id = $_GET['id'];
	$hidden1 = true;
	$hidden2 = true;
	$hidden3 = true;
	$hidden4 = true;

	$query8 = "SELECT allowDisc, allowRate FROM media WHERE mediaid=$id";
	$result8 = mysql_query($query8);
	$result_row8 = mysql_fetch_row($result8);
	if($result_row8[0] == 1){
		$hidden4 = false;
	}

	if(isset($_SESSION['username'])){
		$username=$_SESSION['username'];
		$query3 = "SELECT COUNT(*) FROM `playlist` WHERE mediaid=$id and username='$username'";
		$result3 = mysql_query($query3);
		$result_row = mysql_fetch_row($result3);
		if($result_row[0] == 0){
			$hidden1 = false;
		}
		$query4 = "SELECT COUNT(*) FROM `favorites` WHERE mediaid=$id and username='$username'";
		$result4 = mysql_query($query4);
		$result_row = mysql_fetch_row($result4);
		if($result_row[0] == 0){
			$hidden2 = false;
		}

		if($result_row8[1] == 1){
			$query5 = "SELECT COUNT(*) FROM `ratings` WHERE mediaid=$id and username='$username'";
			$result5 = mysql_query($query5);
			$result_row = mysql_fetch_row($result5);
			if($result_row[0] == 0){
				$hidden3 = false;
			}
		}

	}
	$query6 = "SELECT COUNT(*) FROM ratings WHERE mediaid=$id";
	$result6 = mysql_query($query6);
	if(!$result6){
		die("Could not query db".mysql_error());
	}
	$result_row6 = mysql_fetch_row($result6);
	
	$query7 = "SELECT AVG(stars) FROM `ratings` WHERE mediaid=$id";
	$result7 = mysql_query($query7);
	$result_row7 = mysql_fetch_row($result7);

	$query = "SELECT * FROM media WHERE mediaid='".$_GET['id']."'";
	$result = mysql_query( $query );
	$result_row = mysql_fetch_row($result);
	
	$query9 = "Select distinct keywords.mediaid, media.filename, media.description, media.title from keywords INNER JOIN media on keywords.mediaid = media.mediaid where keyword in (SELECT keyword from keywords where keywords.mediaid = $id) and keywords.mediaid != $id";
	$recomendResult = mysql_query($query9);

	updateMediaTime($_GET['id']);
	
	$filename=$result_row[1];
	$filepath=$result_row[2];
	$type=$result_row[3];
	if(substr($type,0,5)=="image") //view image
	{
		echo "<img src='".$filepath.$filename."'/>";
		echo "<br></br>";
		echo "Viewing Picture:";
		echo $result_row[2].$result_row[1];
	}//audio next
	else if($result_row[3] == "audio/mpeg"){
		echo "<br></br><br></br>";
		echo "<audio controls>";
		echo "<source src=".$result_row[2].$result_row[1]." type='audio/mpeg'>";
		echo "Your Browser does not support this audio element";
		echo "</audio>";
		echo "<br></br>";
		echo "Listening to Audio: ".$result_row[2].$result_row[1];
		echo "<br></br>";
	} else //view movie
	{
		if($result_row[3] != "video/mp4" && $result_row[3] != "video/ogg"){
			echo "Invalid file format for ".$result_row[2].$result_row[1];
		}
		else{	
?>	
			<p>Viewing Video:<?php echo $result_row[2].$result_row[1];?></p>
			
			<video width="400" controls>
				<source src= <?php echo $result_row[2].$result_row[1];?> type=<?php echo $result_row[3];?>>
				Your browser does not support HTML5 video.
			</video>

<?php
		}
	}
}
else
{
?>
<!-- <meta http-equiv="refresh" content="0;url=browse.php"> -->
<?php
}
?>
<div class='container'>
	<div class='columns'>
		<div class='column col-auto'>
			<!-- CHANGE TO ADD A RATING MINNIMUM -->
			<h3>Media Rating: <?php if(!($result_row6[0] > 0)) echo "N/A"; else echo $result_row7[0]."/5.0000"?> </h3>
		</div>
		<div <?php if($hidden3) echo "hidden"; ?> class='column col-auto'>
			<form action="addrating.php" method='post'>
				<div class='columns'>
					<div class='column col-auto'>
						<input hidden name='id' value=<?php echo $id;?>>
						<div class="form-group">
						<select class="form-select" name='mediaRating'>
							<option></option>
							<option>5</option>
							<option>4</option>
							<option>3</option>
							<option>2</option>
							<option>1</option>
						</select>
						</div>
					</div>
					<div class='column col-auto'>
						<input type='submit' class='btn' value="Rate">
					</div>
				</div>
			</form>
		</div>
		<div class='column col-auto'>
			<form action="addtoplaylist.php" method="get"> 
				<input hidden name='id' value=<?php echo $id;?>>
				<input type=<?php if($hidden1) echo "hidden"; else echo "submit"; ?> class="btn" value="Add to Playlist">
			</form>
		</div>
		<div class='column col-auto'>
			<form action="addtofavorites.php" method="get">
			<input hidden name='id' value=<?php echo $id;?>>
				<input type=<?php if($hidden2) echo "hidden"; else echo "submit"; ?> class="btn" value="Add to Favorites">
			</form>
		</div>
	</div>
</div>

<?php 
	$query2 = "SELECT * FROM comments WHERE mediaid ='".$_GET['id']."' ORDER BY time DESC";
	$result2 = mysql_query($query2);
?>
<div <?php if($hidden4) echo " hidden ";?>class="container">
	<form action="media.php" method="get">
		<input hidden name ="id" value=<?php echo $id;?>>
		<input class="form-input" style="width: 300px" type="text" name="comment" placeholder="Write comment here...">
		<input name="submit" type="submit"class=<?php if(!isset($_SESSION['username'])) echo "'btn disabled'"; else echo "'btn'";?> value="Submit Comment">
	</form>
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

</div>
	<div class="column col-auto">
	<h3>Recommendations: </h3>
        <table class="table" width="100%">
            <thead>
                <tr>
                <th>Title</th>
                <th>Filename</th>
                <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($result_row = mysql_fetch_row($recomendResult)){
                        echo "<tr>";
                        echo "<td>".$result_row[3]."</td>";
                        echo "<td><a href='media.php?id=".$result_row[0]."' class='btn' target='_blank'>".$result_row[1]."</a></td>";
                        echo "<td>".$result_row[2]."</td>";
                        echo "</tr>";
                    }
                ?>
         </tbody>
        </table>
	</div>
</div>
</body>
</html>
