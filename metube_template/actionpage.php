<?php
include_once "function.php";
if(isset($_POST['submit'])) {
  if($_POST['lblId'] == "" || $_POST['lpassword'] == "" || $_POST['emailAddress'] == "") {
    header('Location: register.php');
  }
  else {
    $check = register_ID($_POST['lblId'], $_POST['lpassword'], $_POST['emailAddress'], "0"); // Call functions from function.php
    if($check == 1){
      header('Location: index.php');
    }
    else{
      header('Location: register.php');
    }
  }
}

?>