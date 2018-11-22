<?php
    
    echo 0;
    session_start();
    echo 1;

    if (isset($_SESSION['id'], $_GET['post'], $_GET['user'])) {
        try {
            echo 2;
            require_once("../config/setup.php");
            $username = $_GET['user'];
            $postid = $_GET['post'];
            echo $username;

            $sql = "SELECT * FROM posts WHERE id = $postid AND username = '$username'";
            $result = $conn->query($sql);
            echo '4.0';
            if ($result->fetchcolumn() > 0) {
                echo '4.1';
                /*unlink("../upload/" . "$result['picture']");*/
                $sql = "DELETE FROM posts WHERE id = $postid AND username = '$username'";
                echo '5';
                $conn->query($sql);
                header("Location: viewposts.php?itisdone");
                exit();
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