<?php
    session_start();
    include_once "function.php";

    $id = $_GET['id'];
    $username = $_SESSION['username'];
    $query = "INSERT INTO `playlist`(`mediaid`, `username`) VALUES ($id,'$username')";
    $result = mysql_query($query);
    if(!$result){ 
        die("Could not query DB: ".mysql_error());
    }
    header("Location: media.php?id=$id");

?>