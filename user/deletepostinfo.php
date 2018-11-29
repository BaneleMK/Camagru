<?php
    session_start();
    if (isset($_SESSION['id'], $_GET['post'], $_GET['user'])) {
        try {
            require_once("../config/setup.php");
            $username = $_GET['user'];
            $postid = $_GET['post'];

            $sql = "SELECT * FROM posts WHERE id = $postid AND username = '$username'";
            $query = $conn->prepare($sql);
            $query->execute();

            $result = $query->fetch();
            if (isset($result['picture'])) {
                $picture = "../uploadS/" . $result['picture'];
                unlink($picture);

                $sql = "DELETE FROM posts WHERE id = $postid AND username = '$username'";
                $conn->query($sql);
                header("Location: viewposts.php?itisdone");
                exit();
            } else {
                header("Location: viewposts.php?nopostexists");
                exit();
            }
        } catch (PDOException $e) {
            echo "failed: " . $e->getMessage() . "<br>";
        }
    } else {
        header("Location: ../login/login.php");
        exit();
    }