<!DOCTYPE html>
<html>
<style>
input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
input[type=password], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=passwd_result] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

div {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>
<body>

<h3>Register Your Account</h3>

<div>
  <form method='post' action="<?php echo "actionpage.php";?>">
    <label for="fname">First Name</label>
    <input type="text" id="fname" name="firstname" placeholder="Your name..">

    <label for="lname">Last Name</label>
    <input type="text" id="lname" name="lastname" placeholder="Your last name..">
	
	<label for="lblId">ID</label>
    <input type="text" id="lblId" name="lblId" placeholder="Your ID here...">
	
	<label for="lpassword">Password</label>
    <input type="password" id="lpassword" name="lpassword" placeholder="Your password here...">
	
    <label for="lemail">Email Address</label>
    <input type="text" id=lemail name="emailAddress" placeholder="addresss@email.com">
  
    <input type="submit" value="submit" name="submit">
  </form>
</div>
<?php
if(isset($login_error))
   {  echo "<div id='passwd_result'>".$login_error."</div>";}
?>
</body>
</html>





