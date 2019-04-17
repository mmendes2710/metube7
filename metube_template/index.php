<html>
<?php

    session_start();
    include_once "function.php";
    if(isset($_SESSION['username'])){
        header("Location: browse.php");
    }

?>
<head> <!-- BEGIN HEAD -->

<title>Media browse</title>
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

<?php
	$query1 = "SELECT media.mediaid, media.filename, media.filepath, media.title, media.description FROM media ORDER BY mediaid DESC";
    $query = $query1;
    $title = "Browse";

    if(isset($_POST['category']) && $_POST['category'] != ""){
        $category = $_POST['category'];
        $query2 = "SELECT media.mediaid, media.filename, media.filepath, media.title, media.description  FROM media WHERE category='$category' ORDER BY mediaid DESC";
        $query = $query2;
        $title = "Category: ".$category;
    }
    else if(isset($_POST['search']) && $_POST['search'] != ""){
        $keyword=$_POST['search'];
        $query3 = "SELECT media.mediaid, media.filename, media.filepath, media.title, media.description FROM `keywords` INNER JOIN media on keywords.mediaid = media.mediaid WHERE keyword='$keyword'  ORDER BY mediaid DESC";
        $query = $query3;
        $title = "Keyword Search on '".$keyword."'";
    }

    $result = mysql_query($query);
	
?>
<body>


<body> <!-- BEGIN BODY -->
<div class="container">
<!-- Some sort of image here -->
<p> METUBE PROJECT 6620 </p>
<div class="columns">
    <div class="column col-auto">
        <form action="login.php" method="post">
            <input type="submit" class="btn"  VALUE = "Log in" >
        </form>
    </div>
    <div class="column col-auto">
        <form action="register.php" method="post">
            <input type="submit" class="btn"  VALUE = "Register" >
        </form>
    </div>
</div>
 
 
<?php
    $query = @mysql_query("SELECT * FROM account");
?>

<form action="index.php" method="post">
    <div class="columns">
        <div class="column col-auto">
            <?php 
                echo "<h5> Channel Listings: </h5>";
            ?>
        </div>
        <div class="column col-auto">
            <?php
                echo "<select class='form-select' style='width: 300px' name='listingdropdown'>";
                echo "<option></option>";
                while($row = mysql_fetch_array($query)){
                    echo "<option value='".$row[0]."'>".$row[0]."</option>";
                }
                echo "</select>";
            ?>
        </div>
        <div class="column col-auto">
            <input type="submit" class="btn" name="submit" VALUE="Submit" style="width: 200px">
        </div>
    </div>
</form>
<form action="index.php" method="post">
    <div class="container">
        <div class ="columns">
            <div class="column col-auto">
                <h5>Search Metube: </h5>
            </div>
            <div class="column col-auto">
                <input type="text" class="form-input" name="search" style="width:300px" placeholder="Keyword Search...";>
            </div>
            <div class="column col-auto">
                <input type="submit" class="btn" VALUE="Search" style="width: 200px">
            </div>
        </div>
    </div>
</form>
<form action="index.php" method="post">
    <div class="container">
        <div class ="columns">
            <div class="column col-auto">
                <h5>Category: </h5>
            </div>
            <div class="column col-auto">
            <select name="category" id="category" class="form-select">
                        <option></option>
						<option value="Miscellaneous" selected hidden="hidden">Choose here</option>
						<option value="Auto and Vehicles">Auto and Vehicles</option>
						<option value="Beauty and Fashion">Beauty and Fashion</option>
						<option value="Comedy">Comedy</option>
						<option value="Education">Education</option>
						<option value="Entertainment">Entertainment</option>
						<option value="Family Entertainment">Family Entertainment</option>
						<option value="Film and Animation">Film and Animation</option>
						<option value="Food">Food</option>
						<option value="Gaming">Gaming</option>
						<option value="How-to and Style">How-to and Style</option>
						<option value="Music">Music</option>
						<option value="News and Politics">News and Politics</option>
						<option value="Nonprofits and Activism">Nonprofits and Activism</option>
						<option value="People and Blogs">People and Blogs</option>
						<option value="Pets and Animals">Pets and Animals</option>
						<option value="Science and Technology">Science and Technology</option>
						<option value="Sports">Sports</option>
						<option value="Travel and Events">Travel and Events</option>
						<option value="Miscellaneous">Miscellaneous</option>
					</select>
            </div>
            <div class="column col-auto">
                <input type="submit" class="btn" VALUE="Search" style="width: 200px">
            </div>
        </div>
    </div>

</form>
<div class='container'>
    <h3><?php echo $title; ?></h3>
    <table class="table table-striped" width="100%">
            <thead>
                <tr>
                <th>Media ID</th>
                <th>Title</th>
                <th>File Name</th>
                <th>Description</th>
                <th>Download</th>
                </tr>
            </thead>
            <tbody>
                <?php
                        while($result_row = mysql_fetch_row($result)){
                            echo "<tr>";
                            echo "<td>".$result_row[0]."</td>";
                            echo "<td>".$result_row[3]."</td>";
                            //echo "<td>".$result_row[1]."</td>";
                            echo "<td><a href='media.php?id=".$result_row[0]."' class='btn' target='_blank'>".$result_row[1]."</a></td>";
                            echo "<td>".$result_row[4]."</td>";
                            echo "<td><a href='".$result_row[2].$result_row[1]."' class='btn' download='".$result_row[2].$result_row[1]."' target='_blank' onclick='javascript:saveDownload(".$result_row[0].");'>Download</a></td>";
                            echo "</tr>";
                        }
                ?>
         </tbody>
        </table>
</div>


</div>
</body> <!-- END OF BODY -->

