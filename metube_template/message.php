<html>
<head>
<link rel="stylesheet" href="docs/dist/spectre.css">
</head>

<?php
    session_start();
    include_once "function.php";
    if(!isset($_SESSION['username'])){
        header("Location: index.php");
    }

    if(isset($_POST["submit"])){
        if($_POST['toUser']=="" || $_POST['toMessage'] == ""){
            echo "<script>alert('One of more forms are empty!')</script>";
        }
        else{
            $message = send_message($_POST["toUser"],$_SESSION['username'],$_POST['toMessage']);
            if($message == 3){
                echo "<script>alert('This user has blocked you!!!')</script>";
            }
            else if($message == 2){
                echo "<script>alert('This account does not exist!!!')</script>";
            }
            else if($message == 1){
                echo "<script>alert('Message sent successfully')</script>";  
                header("Location: browse.php");
            }
            else{
                echo "<script>alert('Unable to send message')</script>";  
            }
        }
    }
?>
<form action="index.php" method="post">
	<input type='submit' class='btn btn-primary' value="HOME">
</form>
<h1>Send Message</h1>
<body>
    <div class=container>
        <form action="message.php" method="post">
            <div class="form-group">
                <label class="form-label" for="input-example-1">Send Message To:</label>
                <input class="form-input" style="width: 300px" type="text" name="toUser" placeholder="Username...">
                <label class="form-label" for="input-example-3">Message:</label>
                <textarea class="form-input" style="width: 300px" name="toMessage" placeholder="Message..." rows="3"></textarea>
                <input name="submit" type="submit"class="btn" value="Send Message">
            </div>
        </form>
    </div>
</body>