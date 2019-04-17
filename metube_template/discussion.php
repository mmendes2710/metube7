<html>
<head>
<link rel="stylesheet" href="docs/dist/spectre.css">
</head>
<?php
    session_start();
    include_once "function.php";

    $query1 = "SELECT * FROM `discategory`";
    $result1 = mysql_query($query1);
    if(!$result1){ 
        die("Could not query1 DB: ".mysql_error());
    }
    if(isset($_POST['category']) && $_POST['category'] != ""){
        $category = $_POST['category'];
        $query2 = "SELECT categoryid FROM discategory WHERE category='$category'";
        $result2 = mysql_query($query2);
        if(!$result2){ 
            die("Could not query2 DB: ".mysql_error());
        }
        $row = mysql_fetch_row($result2);
        $id = $row[0];
        
        if(isset($_POST['postdis']) && $_POST['discussiontext'] != ""){
            $postdiscussion = send_discussion($id,$_SESSION['username'],$_POST['discussiontext']);
            if($postdiscussion == 1){}
            else{
                echo "<script>alert('Unable to send discussion')</script>";  
            }
            $_POST['discussiontext'] ="";
        }

        $query4 = "SELECT * FROM discussion WHERE discussionid=$id ORDER BY time desc";
        $result4 = mysql_query($query4);
        if(!$result4){ 
            die("Could not query4 DB: ".mysql_error());
        }
    }

    

?>
<body>
    <div class="container">
        <h1>Discussion Groups</h1>
        <div class="columns">
		    <div class="column col-auto">
                <!--
                <form action="discussion.php" method="post">
                    <div class="form-group">
                        <label class="form-label" for="topicText">New Topic String: </label>
                        <input class="form-input" type="text" name="topicText" style="width: 300px" placeholder="Type Topic Here...">
                        <input type="submit" class="btn" value="Submit Topic">
                    </div>
                </form>
                -->
                
                <form action="discussion.php" method="post">
                    <label class="form-label" for="category">Choose Topic: </label>
                    <select class="form-select" name="category" style="width: 300px">
                    <?php 
                        if(isset($_POST['category'])){
                            echo "<option>".$_POST['category']."</option>";
                        }
                        else{
                            echo "<option></option>";
                        }
                        while($result_row = mysql_fetch_row($result1)){
                            echo "<option>".$result_row[1]."</option>";
                        }
                    ?>
                    </select>
                    <input type="submit" class="btn" value="Submit Choice">
                </form> 
    
            </div><!-- COLUMN END-->
            <div class="column-auto">
            <h2><?php if(!isset($_POST['category'])) echo ""; else echo $_POST['category'];?></h2>
                <form action="discussion.php" method="post">
                    <div class="form-group">
                        <label class="form-label" for="discusssiontext">New Comment: </label>
                        <input hidden name ="category" value=<?php if(!isset($_POST['category'])) echo ""; else echo $_POST['category'];?>>
                        <input hidden name ="comment" value=<?php if(!isset($_POST['category'])) echo ""; else echo $_POST['category'];?>>
                        <textarea class="form-input" type="text" name="discussiontext" style="width: 600px" placeholder="Type Comment Here..."></textarea>
                        <input type="submit" name="postdis" class="btn" value="Post" <?php if(!isset($_POST['category'])) echo "disabled";?>>
                    </div>
                </form>
                <table class="table" width="100%">
                    <thead>
                        <tr>
                        <th>User</th>
                        <th>Post</th>
                        <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(isset($_POST['category'])){
                                while($result_row = mysql_fetch_row($result4)){
                                    echo "<tr>";
                                    echo "<td>".$result_row[1]."</td>";
                                    echo "<td>".$result_row[2]."</td>";
                                    echo "<td>".$result_row[3]."</td>";
                                    echo "</tr>";
                                }
                            }
                        ?>
                </tbody>
                </table>
            </div><!-- COLUMN END -->



        </div><!-- COLUMNSSSS END -->
    </div>
</body>
