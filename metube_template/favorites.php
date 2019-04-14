<html>
<?php
    session_start();
    include_once "function.php";
?>
<head>
    <link rel="stylesheet" href="docs/dist/spectre.css">
</head>
<?php

    if(isset($_POST['id'])){
        $mediaid = $_POST['id'];
        $username = $_SESSION['username'];
        $query3 = "DELETE FROM `favorites` WHERE mediaid=$mediaid AND username='$username'";
        $result3 = mysql_query($query3);
        $_POST['id'] = "";
    }

    $username = $_SESSION['username'];
    $query1 = "SELECT * FROM `media` WHERE mediaid IN (SELECT mediaid FROM `favorites` WHERE username='$username')";
    $result1 = mysql_query($query1);

    $query2 = "SELECT * FROM `upload` WHERE uploadid IN (SELECT mediaid FROM `favorites` WHERE username='$username')";
    $result2 = mysql_query($query2);

?>
<body>
    <div class="container">
        <h1> Your Favorites List </h1>
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
                        $result_row2 = mysql_fetch_row($result2);
                        echo "<tr>";
                        echo "<td>".$result_row2[1]."</td>";
                        echo "<td><a href='media.php?id=".$result_row1[0]."' target='_blank'>".$result_row1[1]."</a></td>";
                        echo "<td>".$result_row2[3]."</td>";
                        echo "<td>";
                        echo "<form action='favorites.php' method='post'><input hidden name ='id' value=".$result_row1[0]."><input type='submit' class='btn' value='X'></form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                ?>
         </tbody>
        </table>
    </div>
</body>
