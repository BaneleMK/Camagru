<?php

session_start();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Profile</title>
        <link rel="stylesheet" href="../css/mystyles.css">      
    </head>
    <body bgcolor=red>
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
                <nvli><a class=active href="profile.php">' . $_SESSION['username'] . '</a></nvli>';
            }
            ?>
        </nv>
        <div class="mainbox">
            <div class="subbox">
                    
                <div class="picbox">
                <?php
                    if (isset($_GET['post'])){
                        require_once('config/setup.php');
                        
                        $post = $_GET['post'];

                        $query = $conn->prepare("SELECT * FROM posts WHERE id = $post");
                        $query->execute();

                        $row = $query->fetch();
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
                    } else {
                        header("Location : ../index.php");
                        exit();
                    }
                ?>
                </div>
            </div>   
        </div>
    </body>
</html>