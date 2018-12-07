<?php

    session_start();
    if (isset($_GET['post']) && isset($_SESSION['username'])){
        require_once('../config/setup.php');
        include_once('../functions/sanitize.php');
        try {
            $postid = sanitize($_GET['post']);
            $username = sanitize($_SESSION['username']);
            $comment_text = substr(trim(sanitize($_POST['comment_text'])), 0, 255);

            if ($postid == '') {
                header("Location: ../index.php?");
                exit();
            }

            //insert the comment
            //echo $postid . '<br>' . $username . '<br>' . $comment_text . '<br>';
            
            $sql = "INSERT INTO user_comments (username, comment_text, postid) VALUES ('$username', '$comment_text', '$postid')";
            $conn->query($sql);

            //get current comment num and add one to it
            $query = $conn->prepare("SELECT * FROM posts WHERE id = $postid");
            $query->execute();
            $row = $query->fetch();

            $newcomments = $row['comments'] + 1;
            $postusername = $row['username'];

            $sql = "UPDATE posts SET comments = $newcomments WHERE id = $postid";
            $stmt = $conn->prepare($sql);
            $stmt->execute(); 

            //inform the user if its notification is on

            $query = $conn->prepare("SELECT * FROM users WHERE username = '$postusername'");
            $query->execute();
            $row = $query->fetch();

            $email = $row['email'];
            if ($row['comment_notifications'] != 'OFF') {
                //if its on send an email notifying

                $email_messaage = "
                One of your posts received a comment from the legend $username.
                Check it out with the link below.
                ---------
                http://localhost:8080/Camagru/user/comments.php?post=$postid
                ---------";

                mail($email, "Trender - new comment on post", $email_messaage,"From: Trendernoreply.com");
            }
            header("Location: comments.php?post=" . $postid);
            echo 'madeit';
            exit();
        } catch (PDOException $e) {
            echo "failed: " . $e->getMessage() . "<br>";
        }
    } else {
        header("Location: ../login/login.php?");
        exit();
    } 