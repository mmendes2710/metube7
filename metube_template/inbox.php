<html>
<head>
<link rel="stylesheet" href="docs/dist/spectre.css">
</head>

<?php
    session_start();
    include_once "function.php";
    //if(!isset($_SESSION['username'])){
    //	header('Refresh:0; index.php');
    //}  
    $name = $_SESSION['username'];
    $query = "SELECT * FROM messages WHERE toUser='$name' order by time desc";
    $result = mysql_query($query);
    if(!$result){
        die("Could not query database: ".mysql_error());
    }
?>

<body>
    <div class="container">
        <h1>Message Inbox </h1>
        <form action="message.php" method="post">
			<input type="submit" class="btn" value="Send Message">
		</form>
        <table class="table" width="100%">
            <thead>
                <tr>
                <th>ID</th>
                <th>From</th>
                <th>Message</th>
                <th>Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($result_row = mysql_fetch_row($result)){
                        $toUser = $result_row[0];
                        $fromUser = $result_row[1];
                        $message = $result_row[2];
                        $time = $result_row[3];

                        echo "<tr>";
                        echo "<td>".$toUser."</td>";
                        echo "<td>".$fromUser."</td>";
                        echo "<td>".$message."</td>";
                        echo "<td>".$time."</td>";
                        echo "</tr>";
                    }
                ?>
         </tbody>
        </table>



    </div>

</body>

