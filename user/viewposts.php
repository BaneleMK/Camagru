<?php

session_start();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Homepage</title>
        <link rel="stylesheet" href="../css/mystyles.css">        
    </head>
    <body>
        <nv>
            <nvli style="float: left;"><a href="../index.php">Home</a></nvli>
            <?php
            if (!isset($_SESSION['id']))
            {
                echo '
                    <nvli><a href="../signup/signup.php">Sign up</a></nvli>
                    <nvli><a href="../login/login.php">Login</a></nvli>';
            }
            else
            {
                echo '
                <nvli><a href="../login/logout.php">Logout</a></nvli>
                <nvli><a href="post.php">Post</a></nvli>
                <nvli><a class=active href="user/viewposts.php">View Posts</a></nvli>
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

                        $user = $_SESSION['username'];
                        $query = $conn->prepare("SELECT * FROM posts WHERE username = '$user'");
                        $query->execute();

                        for ($i = 0; $row = $query->fetch(); $i++) {
                        echo '
                        <div class="postflexbox">
                                <img src="../uploads/' . $row['picture'] . '">
                                <div class="postoptionsflexbox">
                                    <options><flextext>' . $row['username'] . ' </flextext></options>
                                    <options><flextext>' . $row['likes'] . ' Likes</flextext></options>
                                    <options><flextext>' . $row['comments'] . ' <a href="user/comments.php?post=' . $row['id'] . '">Comments</a></flextext></options>
                                </div>
                                <div class="postoptionsflexbox">
                                    <flextext><a href="deletepostinfo.php?post=' . $row['id'] . '&user=' . $user . '">DELETE POST</a></flextext>
                                </div>
                        </div>';
                        }
                    ?>
                    </div>
            </div>   
        </div>
    </body>
</html>