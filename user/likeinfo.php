<?php

    session_start();
    if (isset($_GET['post']) && isset($_SESSION['username'])){
        require_once('../config/setup.php');
        include_once('../functions/sanitize.php');
        try {
            
            $postid = sanitize($_GET['post']);
            $username = sanitize($_SESSION['username']);
            
            $stmt = $conn->prepare("SELECT * FROM posts WHERE id = $postid");
            $stmt->execute();
            $row = $stmt->fetch();

            $stmt = $conn->prepare("SELECT COUNT(*) FROM likes WHERE postid = $postid AND username = '$username'");
            $stmt->execute();

            if ($stmt->fetchcolumn() > 0) {
                $newlikes = $row['likes'] - 1;
                if ($newlikes < 0) {
                    $newlikes = 0;
                }
                $conn->prepare("DELETE FROM likes WHERE postid = $postid AND username = '$username'");
                $stmt->execute();
            } else {
                $newlikes = $row['likes'] + 1;
                $stmt = $conn->prepare("INSERT INTO likes (postid, username) VALUES ($postid, '$username')");
                $stmt->execute();
            }

            $sql = "UPDATE posts SET likes = $newlikes WHERE id = $postid";
            $stmt = $conn->prepare($sql);
            $stmt->execute();        
            header("Location: comments.php?post=" . $postid);
            exit();
        } catch (PDOException $e) {
            //echo "failed: " . $e->getMessage() . "<br>";
            header("Location: comments.php?post=" . $postid ."&error");
            exit();
        }
    } else {
        header("Location: ../login/login.php?");
        exit();
    }
