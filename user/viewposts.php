<?php

session_start();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Trender-MyPosts</title>
        <link rel="stylesheet" href="../css/mystyles.css">        
    </head>
    <body>
        <nv>
            <nvli style="float: left;"><a href="../index.php">Home</a></nvli>
            <?php
            if (!isset($_SESSION['id'])) {
                echo '
                    <nvli><a href="../signup/signup.php">Sign up</a></nvli>
                    <nvli><a href="../login/login.php">Login</a></nvli>';
            } else {
                echo '
                <nvli><a href="../login/logout.php">Logout</a></nvli>
                <nvli><a href="post.php">Post</a></nvli>
                <nvli><a class=active href="viewposts.php">View Posts</a></nvli>
                <nvli><a href="profile.php">' . $_SESSION['username'] . '</a></nvli>';
            }
            ?>
        </nv>
        <div class="mainbox">
            <div class="subbox">
                <!--<div class="optionbox">
                    
                </div>-->
                    <div class="columnflexbox">
                    <?php
                        require_once('../config/setup.php');

                        $query = $conn->prepare("SELECT * FROM posts");
                        $query->execute();
                        $row = $query->fetchAll();

                        // $postnumber = the amount of posts per pagination
                        if (isset($_GET['page'])){
                            if ($_GET['page'] < 0)
                                $page = 0;
                            else
                                $page = $_GET['page'];
                        }
                        else
                            $page = 0;

                        $postnumber = 5;

                        $startat = $page * $postnumber;

                        $totalposts = sizeof($row);
                        // cp = currentpage
                        for ($cp = $startat; ($cp < ($startat + 5)) && ($cp < $totalposts); $cp++) {
                            echo '
                            <div class="postflexbox">
                                    <img src="uploads/' . $row[$cp]['picture'] . '">
                                    <div class="postoptionsflexbox">
                                        <options><flextext>' . $row[$cp]['username'] . ' </flextext></options>
                                        <options><flextext>' . $row[$cp]['likes'] . ' <a href="likeinfo.php?post=' . $row['id'] . '&like ">Likes</a></options>
                                        <options><flextext>' . $row[$cp]['comments'] . ' <a href="comments.php?post=' . $row['id'] . '">Comments</a></flextext></options>
                                    </div>
                            </div>';    
                        }

                        echo '
                            <div class="postoptionsflexbox">
                                <options><flextext><a href=../index.php?page=0>First</a></flextext></options>
                                <options><flextext><a href=../index.php?page=' . ($page - 1) . '>Back</a></flextext></options>
                                <options><flextext>' . $page . '</flextext></options>
                                <options><flextext><a href=../index.php?page=' . ($page + 1) . '>next</a></flextext></options>
                            </div>';

                        /*for ($i = 0; ; $i++) {
                        echo '
                        <div class="postflexbox">
                                <img src="uploads/' . $row[]['picture'] . '">
                                <div class="postoptionsflexbox">
                                    <options><flextext>' . $row['username'] . ' </flextext></options>
                                    <options><flextext>' . $row['likes'] . ' <a href="user/likeinfo.php?post=' . $row['id'] . '&like ">Likes</a></options>
                                    <options><flextext>' . $row['comments'] . ' <a href="user/comments.php?post=' . $row['id'] . '">Comments</a></flextext></options>
                                </div>
                        </div>';
                        }*/
                    ?>
                    </div>
            </div>   
        </div>
    </body>
</html>