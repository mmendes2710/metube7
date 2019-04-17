<?php
    session_start();
    include_once "wordcloud.php";
?>
<form action="browse.php" method="post">
	<input type='submit' class='btn btn-primary' value="HOME">
</form>
<?php

    $cloud = new Wordcloud();
    echo $cloud->buildCloud();

    if(isset($_GET['keyword']) && $_GET['keyword'] != ""){
        $keyword = $_GET['keyword'];
        $query1 = "SELECT media.mediaid, media.filename, media.filepath, media.title, media.description FROM `keywords` INNER JOIN media on keywords.mediaid = media.mediaid WHERE keyword='$keyword'  ORDER BY mediaid DESC";
        $result1 = mysql_query($query1);
    }


?>
<link rel="stylesheet" href="docs/dist/spectre.css">
<br></br>
<div class='container'>
	<h3>Results: </h3>
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
                    if(isset($_GET['keyword']) && $_GET['keyword'] != ""){
                        while($result_row = mysql_fetch_row($result1)){
                            echo "<tr>";
                            echo "<td>".$result_row[0]."</td>";				
                            echo "<td>".$result_row[3]."</td>";
                            //echo "<td>".$result_row[1]."</td>";
                            echo "<td><a href='media.php?id=".$result_row[0]."' class='btn' target='_blank'>".$result_row[1]."</a></td>";
                            echo "<td>".$result_row[4]."</td>";
                            echo "<td><a href='".$result_row[2].$result_row[1]."' class='btn' download='".$result_row[2].$result_row[1]."' target='_blank' onclick='javascript:saveDownload(".$result_row[0].");'>Download</a></td>";
                            echo "</tr>";
                        }
                    }
				?>
			</tbody>
		</table>
</div>
				