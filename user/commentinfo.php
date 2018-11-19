<?php

    session_start();
    if (isset($_GET['post']) && isset($_SESSION['username'])){
        require_once('../config/setup.php');
        include_once('../functions/sanitize.php');
        try {
            $postid = sanitize($_GET['post']);
            $username = sanitize($_SESSION['username']);
            $comment = sanitize($_POST['comment']);
            $sql = "INSERT INTO comments (username, postid, comment) VALUES ('$username', '$postid, '$comment')";
            $conn->query($sql);
            header("Location: comments.php?post=" . $postid);
            exit();
        } catch (PDOException $e) {
            echo "failed: " . $e->getMessage() . "<br>";
        }
    } else {
        header("Location: ../index.php?notlogged");
        exit();
    } 