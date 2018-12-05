<?php

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Trender-comments</title>
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
                <nvli><a href="viewposts.php">View Posts</a></nvli>
                <nvli><a class=active href="profile.php">' . $_SESSION['username'] . '</a></nvli>';
            }
            ?>
        </nv>
        <div class="mainbox">
            <div class="subbox">
                    
                <div class="picbox">
                <?php
                    if (isset($_GET['post'])){
                        require_once('../config/setup.php');
                        
                        $post = $_GET['post'];

                        $query = $conn->prepare("SELECT * FROM posts WHERE id = $post ");
                        $query->execute();

                        $row = $query->fetch();
                        echo '
                        <div class="postflexbox">
                            <table>
                                <tr>
                                    <td colspan=2><img src="../uploads/' . $row['picture'] . '" class="postimages" </td>
                                </tr>
                                <tr>
                                    <td>@' . $row['username'] . ' </td>
                                </tr>
                                <tr>
                                    <td>' . $row['likes'] . ' <img href="likeinfo.php?post=' . $_GET['post'] . '&like ">Likes</a></td>
                                    <td>' . $row['comments'] . '<a href="comments.php?post=' . $row['id'] . '">' . ' Comments </td>
                                </tr>
                            </table>
                        </div>
                        <div class="commentflexbox">
                            <form action="commentinfo.php?post=' . $row['id'] . '&comments " method=POST id="commentform">
                                    <table class=table>
                                            <tr>
                                                <td><h3>Comment</h3></td>
                                                <td><textarea rows="3" cols="50" name="comment_text" form="commentform" required placeholder="Hey, say something :D (max chars:255)"></textarea></td>
                                            </tr>
                                            <tr>
                                               <td><button type="submit" name="submit" required>post comment</button></td>
                                           </tr>
                                    </table>
                            </form>
                        </div>';

                        $query = $conn->prepare("SELECT * FROM user_comments WHERE postid = $post");
                        $query->execute();

                        echo '
                        <div class="commentflexbox" style="height:650">';
                        while ($com = $query->fetch()) {
                            echo '<div class="commentflexbox" style="height:50px ; width=90%;background-color: #EEEEEE;">
                        ' . $com['username'] . ': ' . $com['comment_text'] . '
                            </div>';
                        }
                        echo '</div>';
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