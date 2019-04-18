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
</head>
<form action="browse.php" method="post">
	<input type='submit' class='btn btn-primary' value="HOME">
</form>
<?php
    
    if(isset($_POST['chaName']) && $_POST['chaName'] != ""){
        $chaName = $_POST['chaName'];
        $username = $_SESSION['username'];
        $query3 = "DELETE FROM `subscriptions` WHERE subscribeto='$chaName' AND username='$username'";
        $result3 = mysql_query($query3);
        $_POST['chaName'] = "";
    }
    
    $username = $_SESSION['username'];
    $query1 = "SELECT subscribeto FROM subscriptions WHERE username='$username'";
    $result1 = mysql_query($query1);

?>
<body>
    <div class="container">
        <h1> Your Subscriptions </h1>
        <table class="table" width="100%">
            <thead>
                <tr>
                <th>Channel</th>
                <th>Unsubscribe</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($result_row1 = mysql_fetch_row($result1)){
                        
                        echo "<tr>";
                        echo "<td>";
                        echo "<form action='send_to_channel.php' method='post'><input hidden name ='listingdropdown' value='".$result_row1[0]."'><input type='submit' class='btn' value='".$result_row1[0]."'></form>";
                        //echo "<td>".$result_row1[0]."</td>";
                        echo "</td>";
                        echo "<td>";
                        echo "<form action='subscriptions.php' method='post'><input hidden name ='chaName' value=".$result_row1[0]."><input type='submit' class='btn' value='Unsubscribe'></form>";
                        echo "</td>";
                        echo "</tr>";
                        
                    }
                ?>
         </tbody>
        </table>
    </div>
</body>