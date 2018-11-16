<?php

session_start();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Homepage</title>
        <link rel="stylesheet" href="css/mystyles.css">        
    </head>
    <body>
        <nv>
            <nvli style="float: left;"><a class=active href="index.php">Home</a></nvli>
            <?php
            if (!isset($_SESSION['id']))
            {
                echo '
                    <nvli><a href="signup/signup.php">Sign up</a></nvli>
                    <nvli><a href="login/login.php">Login</a></nvli>';
            }
            else
            {
                echo '
                <nvli><a href="login/logout.php">Logout</a></nvli>
                <nvli><a href="user/post.php">Post</a></nvli>
                <nvli><a href="user/profile.php">' . $_SESSION['username'] . '</a></nvli>';
            }
            ?>
        </nv>
        <div class="mainbox">
            <div class="subbox">
                <div class="optionbox">
                    
                </div>
                    <div class="columnflexbox">
                    <?php
                        require_once('config/setup.php');

                        $query = $conn->prepare("SELECT * FROM posts");
                        $query->execute();

                        for ($i = 0; $row = $query->fetch(); $i++) {
                        /*echo '
                        <div class="postflexbox">
                            <table>
                                <tr>
                                    <td colspan=2><img src="uploads/' . $row['picture'] . '" class="postimages" </td>
                                </tr>
                                <tr>
                                    <td>@' . $row['username'] . ' </td>
                                </tr>
                                <tr>
                                    <td>' . $row['likes'] . ' Likes</td>
                                    <td>' . $row['comments'] . '<a href="user/comments.php?post=' . $row['id'] . '">' . ' Comments </td>
                                </tr>
                            </table>
                        </div>';
                        echo '*/
                        echo '
                        <div class="postflexbox">
                                <img src="uploads/' . $row['picture'] . '">
                                <div class="postoptionsflexbox">
                                    <options><flextext>' . $row['username'] . ' </flextext></options>
                                    <options><flextext>' . $row['likes'] . ' Likes</flextext></options>
                                    <options><flextext>' . $row['comments'] . ' <a href="user/comments.php?post=' . $row['id'] . '">Comments</a></flextext></options>
                                </div>
                        </div>';
                        }
                    ?>
                    </div>
            </div>   
        </div>
    </body>
</html>