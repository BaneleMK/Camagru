<?php

    session_start();
    if (isset($_GET['post']) && isset($_SESSION['username'])){
        require_once('../config/setup.php');
        try {

            $postid = $_GET['post'];
            $username = $_SESSION['username'];

            if (isset($_GET['like'])) {
                $query = $conn->prepare("SELECT * FROM posts WHERE id = $postid");
                $query->execute();
                $row = $query->fetch();

                $query = $conn->query("SELECT COUNT(*) FROM likes WHERE postid = $postid AND username = '$username'");
                if ($query->fetchcolumn() > 0) {
                    $newlikes = $row['likes'] - 1;
                    if ($newlikes < 0)
                        $newlikes = 0;
                    $conn->query("DELETE FROM likes WHERE postid = $postid AND username = '$username'");
                } else {
                    $newlikes = $row['likes'] + 1;
                    $conn->query("INSERT INTO likes (postid, username) VALUES ($postid, '$username')");
                }
                $sql = "UPDATE posts SET likes = $newlikes WHERE id = $postid";
                $stmt = $conn->prepare($sql);
                $stmt->execute();        
                header("Location: ../index.php?workslike");
                exit();
            } else if (isset($_GET['comment'])) {
                $comment = $_POST['comment'];

                $sql = "INSERT INTO comments (postid, username, comment) VALUES ($postid, '$username', '$comment')";
                $stmt = $conn->prepare($sql);
                $stmt->execute();

                header("Location: ../index.php?workscomm");
                exit();
            }
        } catch (PDOException $e) {
            echo "failed: " . $e->getMessage() . "<br>";
        }
    } else {
        header("Location: ../index.php?notlogged");
    }