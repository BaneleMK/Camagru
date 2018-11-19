<?php

    session_start();
    if (isset($_GET['post']) && isset($_SESSION['username'])){
        require_once('../config/setup.php');
        include_once('../functions/sanitize.php');
        try {
            
            $postid = sanitize($_GET['post']);
            $username = sanitize($_SESSION['username']);
            
            $query = $conn->prepare("SELECT * FROM posts WHERE id = $postid");
            $query->execute();
            $row = $query->fetch();

            $query = $conn->query("SELECT COUNT(*) FROM likes WHERE postid = $postid AND username = '$username'");

            if ($query->fetchcolumn() > 0) {
                $newlikes = $row['likes'] - 1;
                if ($newlikes < 0) {
                    $newlikes = 0;
                }
                $conn->query("DELETE FROM likes WHERE postid = $postid AND username = '$username'");
            } else {
                $newlikes = $row['likes'] + 1;
                $conn->query("INSERT INTO likes (postid, username) VALUES ($postid, '$username')");
            }

            $sql = "UPDATE posts SET likes = $newlikes WHERE id = $postid";
            $stmt = $conn->prepare($sql);
            $stmt->execute();        
            header("Location: comments.php?post=" . $postid);
            exit();
        } catch (PDOException $e) {
            echo "failed: " . $e->getMessage() . "<br>";
        }
    } else {
        header("Location: ../index.php?notlogged");
        exit();
    }

    /*
    The code for the comments

    else if (isset($_GET['comments'])) {
                //$comment = $_POST['comment'];
                $comment = "is the comment the issue";
                //$conn->query("INSERT INTO likes (postid, username) VALUES ($postid, '$username')");
                $conn->query("INSERT INTO comments (username, postid, comment) VALUES ('$username', $postid, '$comment')");
                header("Location: ../index.php?workscomm");
                exit();
            }*/