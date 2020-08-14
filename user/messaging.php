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
        <meta charset="UTF-8">
    </head>
    <body bgcolor=red>
        <nv>
            <nvli style="float: left;"><a href="../index.php">Home</a></nvli>
        </nv>
        <div class="mainbox">
            <div class="subbox">
                    
                <div class="picbox">
                <?php
                    if (isset($_GET['post'])){
                        
                        $stmt = $conn->prepare("SELECT * FROM user_comments WHERE postid = $post");
                        $stmt->execute();

                        echo '
                        <div class="commentflexbox" style="height:650">';
                        while ($com = $stmt->fetch()) {
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