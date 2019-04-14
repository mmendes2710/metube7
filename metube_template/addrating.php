<?php
    session_start();
    include_once "function.php";

    if(isset($_POST['mediaRating']) && $_POST['mediaRating'] != ""){
        $id = $_POST['id'];
        $username = $_SESSION['username'];
        $stars = $_POST['mediaRating'];
        $query1 = "INSERT INTO `ratings`(`mediaid`, `username`, `stars`) VALUES ($id,'$username',$stars)";
        $result1 = mysql_query($query1);
        if (!$result1){
            echo "<script>alert('Unable to Rate!')</script>";
		}
        header("Location: media.php?id=$id");
    }
    else{
        $id = $_POST['id'];
        echo "<script>alert('Unable to Rate!')</script>";
        header("Location: media.php?id=$id");
    }


?>