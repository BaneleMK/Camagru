<?php
    session_start();
    if (isset($_SESSION['id'], $_GET['post'], $_GET['user'])) {
        try {
            require_once("../config/setup.php");
            $username = $_GET['user'];
            $postid = $_GET['post'];

            $sql = "SELECT * FROM posts WHERE id = $postid AND username = '$username'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetch();
            if (isset($result['picture'])) {
                $picture = "../uploads/" . $result['picture'];
                unlink($picture);

                $sql = "DELETE FROM posts WHERE id = $postid AND username = '$username'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();

                header("Location: viewposts.php?itisdone");
                exit();
            } else {
                header("Location: viewposts.php?nopostexists");
                exit();
            }
        } catch (PDOException $e) {
            //echo "failed: " . $e->getMessage() . "<br>";
            header("Location: viewposts.php?nopostexists&error");
            exit();
        }
    } else {
        header("Location: ../login/login.php");
        exit();
    }