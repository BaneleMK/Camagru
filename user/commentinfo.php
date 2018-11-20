<?php

    session_start();
    if (isset($_GET['post']) && isset($_SESSION['username'])){
        require_once('../config/setup.php');
        include_once('../functions/sanitize.php');
        try {
            $postid = sanitize($_GET['post']);
            $username = sanitize($_SESSION['username']);
            $comment_text = sanitize($_POST['comment_text']);

            //insert the comment
            echo $postid . '<br>' . $username . '<br>' . $comment_text . '<br>';
            $sql = "INSERT INTO user_comments (username, comment_text, postid) VALUES ('$username', '$comment_text', '$postid')";
            $conn->query($sql);

            //get current comment num and add one to it
            $query = $conn->prepare("SELECT comments FROM posts WHERE id = $postid");
            $query->execute();
            $row = $query->fetch();

            $newcomments = $row['comments'] + 1;

            $sql = "UPDATE posts SET comments = $newcomments WHERE id = $postid";
            $stmt = $conn->prepare($sql);
            $stmt->execute(); 

            //inform the user if its notification is on

            $sql = $conn->prepare("SELECT * FROM users WHERE username = '$username'");
            $conn->query($sql)
            $row = $query->fetch();

            if ($row['comment_notifications'] == 'YES') {
                //if its on send an email notifying

                $email_messaage = "
                One of your posts received a comment. Check it out with the link below.
                ---------
                http://localhost:8080/Camagru/user/comments/post=$postid
                ---------";

                mail($row['email'], "Trender - new comment on post", $email_messaage,"From: Trendernoreply.com");
            }

            header("Location: comments.php?post=" . $postid);
            exit();
        } catch (PDOException $e) {
            echo "failed: " . $e->getMessage() . "<br>";
        }
    } else {
        header("Location: ../index.php?notlogged");
        exit();
    } 