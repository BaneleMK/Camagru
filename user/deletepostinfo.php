<?php
    session_start();
    if (isset($_SESSION['id'], $_GET['post'], $_GET['user'])) {
        try {
            require_once("../config/setup.php");
            $username = $_GET['user'];
            $postid = $_GET['post'];
            echo $username;

            $sql = "SELECT * FROM posts WHERE id = $postid AND username = '$username'";
            $query = $conn->prepare($sql);
            $query->execute();

            $result = $query->fetch();
            echo '4.0';
            if (isset($result['picture'])) {
                echo 'picture';
                $picture = "../upload/" . $result['picture'];
                echo $picture . "<br>";
                unlink($picture);
                $sql = "DELETE FROM posts WHERE id = $postid AND username = '$username'";
                echo '5';
                $conn->query($sql);
                //header("Location: viewposts.php?itisdone");
                //exit();
            } else {
                echo '4.2';
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