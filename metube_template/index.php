<html>
<?php

    session_start();
    if(isset($_SESSION['username'])){
        session_unset();
        session_destroy();
    }
    include_once "function.php";

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head> <!-- BEGIN HEAD -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Media browse</title>
<link rel="stylesheet" type="text/css" href="css/default.css" />
<script type="text/javascript" src="js/jquery-latest.pack.js">
function saveDownload(id)
{
	$.post("media_download_process.php",
	{
       id: id,
	},
	function(message) 
    { }
 	);
} 
</script>
<link rel="stylesheet" href="docs/dist/spectre.css">
</head> <!-- END OF HEAD -->
<body> <!-- BEGIN BODY -->
<!-- Some sort of image here -->
<p> METUBE PROJECT 6620 </p>

<form action="login.php" method="post">
    <input type="submit" class="btn"  VALUE = "Log in" >
</form> 
<form action="register.php" method="post">
    <input type="submit" class="btn"  VALUE = "Register" >
</form> 

<br><br>

<form action="index.php" method="post">
    <div class="btn-group">
        Search Metube: &nbsp; 
        <input type="text" class="form-input" name="search" style="width: 500px" placeholder="media...";>
        &nbsp;
        <input type="submit" class="btn" VALUE="Search" style="width: 200px">
    </div>

</form>


<?php
    $query = @mysql_query("SELECT * FROM account");
?>

<form action="" method="post">
    <?php 
        echo "<b> Channel Listings: </b>".'<select class="form-select" style="width: 300px" name="listingdropdown">';
        echo "<option value='None'>".None."</option>";
        while($row = mysql_fetch_array($query)){
            echo "<option value='".$row[0]."'>".$row[0]."</option>";
        }
    ?>
</form>



</body> <!-- END OF BODY -->

