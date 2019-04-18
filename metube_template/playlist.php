<html>
<?php
    session_start();
    include_once "function.php";
    if(!isset($_SESSION['username'])){
        header("Location: index.php");
    }
?>

<head>
    <link rel="stylesheet" href="docs/dist/spectre.css">
    <form action="browse.php" method="post">
	    <input type='submit' class='btn btn-primary' value="HOME">
    </form>
</head>
<form action="browse.php" method="post">
	<input type='submit' class='btn btn-primary' value="HOME">
</form>
<?php

    if(isset($_POST['id'])){
        $mediaid = $_POST['id'];
        $username = $_SESSION['username'];
        $query3 = "DELETE FROM `playlist` WHERE mediaid=$mediaid AND username='$username'";
        $result3 = mysql_query($query3);
        $_POST['id'] = "";
    }

    $username = $_SESSION['username'];
    $query1 = "SELECT media.mediaid, media.filename, upload.uploadtime, upload.username FROM `media` INNER JOIN upload ON media.mediaid=upload.mediaid WHERE media.mediaid IN (SELECT mediaid FROM `playlist` WHERE username='$username')";
    $result1 = mysql_query($query1);

?>
<body>
    <div class="container">
        <h1> Your Playlist </h1>
        <table class="table" width="100%">
            <thead>
                <tr>
                <th>User</th>
                <th>Media</th>
                <th>Time</th>
                <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($result_row1 = mysql_fetch_row($result1)){
                        //$result_row2 = mysql_fetch_row($result2);
                        echo "<tr>";
                        echo "<td>".$result_row1[3]."</td>";
                        echo "<td><a href='media.php?id=".$result_row1[0]."' target='_blank'>".$result_row1[1]."</a></td>";
                        echo "<td>".$result_row1[2]."</td>";
                        echo "<td>";
                        echo "<form action='playlist.php' method='post'><input hidden name ='id' value=".$result_row1[0]."><input type='submit' class='btn' value='X'></form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                ?>
         </tbody>
        </table>
    </div>
</body>