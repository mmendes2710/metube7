<?php
    session_start();
    include "function.php";

    $chaName = $_POST['chaName'];
    $_POST['chaName'] = "";
    $username = $_SESSION['username'];
    $query1 = "INSERT INTO `subscriptions`(`username`, `subscribeto`) VALUES ('$username','$chaName')";
    $result1 = mysql_query($query1);
    if(!$result1){
        die("Could not query DB: ".mysql_error());
    }
    else{
        header("Location: browse.php");
    }
    
?>