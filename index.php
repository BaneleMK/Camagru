<?php

session_start();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Homepage</title>
        <link rel="stylesheet" href="css/mystyles.css">        
    </head>
    <body bgcolor=red>
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
            <?php
                if (isset($_GET['redir'])) {
                    echo '<p>welcome back home</p>';
                }
            ?>
            <div class="subbox">
                <div class="optionbox">
                    
                </div>
                <div class="picbox">
                <?php
                    require_once('config/setup.php');

                    $query = $conn->prepare("SELECT * FROM posts");
                    $query->execute();

                    for ($i = 0; $row = $query->fetch(); $i++) {
                    echo '
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
                    }
                ?>
                </div>
            </div>   
        </div>
    </body>
</html>