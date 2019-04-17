<?php
  session_start();
  include_once "function.php";
?>
<!DOCTYPE html>
<html>
<?php
  
  if(isset($_SESSION['username'])){
    header("Location: browse.php");
  }

  if(isset($_POST['submit'])) {
    if($_POST['lblId'] == "" || $_POST['lpassword'] == "" || $_POST['emailAddress'] == "" || $_POST['clpassword'] == "" || $_POST['firstname'] == "" || $_POST['lastname'] == "" || $_POST['emailAddress'] == "" ) {
      echo "<script>alert('One or more forms were missing!')</script>";
      
    }
    else if($_POST['lpassword'] != $_POST['clpassword']){
      echo "<script>alert('Passwords do not match!')</script>";
    }
    else {
      $check = register_ID($_POST['lblId'], $_POST['lpassword'], $_POST['emailAddress'], "0"); // Call functions from function.php
      if($check == 1){
        $_SESSION["username"]=$_POST["username"]; //Set the $_SESSION['username']
        sleep(3);
        header('Location: login.php');
      }
      else{
        echo "<script>alert('Error Registering!')</script>";
      }
    }
  }

?>
<head>
<link rel="stylesheet" href="docs/dist/spectre.css">
</head>
<body>

<h3>Register Your Account</h3>

<div class="container">
  <form method='post' action="<?php echo "register.php";?>">
    <label class="form-label" for="fname">First Name:</label>
    <input type="text" class="form-input" id="fname" name="firstname" style="width: 300px" placeholder="Your name..">

    <label class="form-label" for="lname">Last Name:</label>
    <input type="text" class="form-input" style="width: 300px" id="lname" name="lastname" placeholder="Your last name..">
	
	  <label class="form-label" for="lblId">ID:</label>
    <input type="text" class="form-input" style="width: 300px" id="lblId" name="lblId" placeholder="Your ID here...">
	
	  <label class="form-label" for="lpassword">Password:</label>
    <input class="form-input" style="width: 300px" type="password" id="lpassword" name="lpassword" placeholder="Your password here...">
    <label class="form-label" for="clpassword">Confirm Password:</label>
    <input class="form-input" style="width: 300px" type="password" id="clpassword" name="clpassword" placeholder="Confirm password here...">
	
    <label class="form-label" for="lemail">Email Address</label>
    <input class="form-input" style="width: 300px" type="text" id=lemail name="emailAddress" placeholder="addresss@email.com">
  
    <input type="submit" class="btn" value="submit" name="submit">
  </form>
</div>
</body>
</html>





