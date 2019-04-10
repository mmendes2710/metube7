<link rel="stylesheet" href="docs/dist/spectre.css">
<?php
    session_start();
    include_once "function.php";
    if(isset($_POST['submit'])){
        if($_POST['username'] == "" || $_POST['password'] == "") {
			echo "<script>alert('One or more forms are missing!')</script>";  
		}
		else {
			$check = user_pass_check($_POST['username'], $_POST['password']); // Call functions from function.php
			if($check == 1) {
				echo "<script>alert('Username not found!')</script>";  
			}
			elseif($check==2) {
				echo "<script>alert('Password is incorrect!')</script>";  
			}
			else if($check==0){
				$_SESSION["username"]=$_POST["username"]; //Set the $_SESSION['username']
                //header('Location: ');
                echo "<script>alert('CORRECT!!!')</script>"; 
			}		
		}
    }
?>

<form method="post" action="<?php echo "login.php"; ?>">
    <table width="100%">
        <tr>
            <td>Username:<input class="form-input" style="width: 300px" id="username" type="text" name="username"><br /></td>
        </tr>
        <tr>
            <td>Password:<input class="form-input" style="width: 300px"  type="password" name="password"><br /></td>
        </tr>
        <tr>
            <td><input name="submit" type="submit" class="btn" value="Login">
            <input name="reset" type="reset"class="btn" value="Reset">
            <a href="register.php" class="btn">Register</a>  
        </tr>
    </table>
</form>