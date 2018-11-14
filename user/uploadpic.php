<?php
    if (isset($_POST['submit'])) {
        try {
            echo "destroy0<br>";
            require_once("../config/setup.php");
            session_start();


            $file = $_FILES['file'];
            echo "destroy<br>";
            $filename = $_FILES['file']['name'];
            $filetmplocation = $_FILES['file']['tmp_name'];
            $filesize = $_FILES['file']['size'];
            $fileerror = $_FILES['file']['error'];
            echo "destroy2<br>";

            $explodedname = explode('.', $filename);
            $import_file_ext = end($explodedname);
            echo "destroy3<br>";
            $file_ext = array('png', 'jpeg', 'jpg');
            echo "destroy4<br>";
            if (in_array($import_file_ext, $file_ext)) {
                if ($filesize <= 10000000) {
                    echo "destroy5<br>";
                    $image_storage_name = uniqid('', true) . '.' . $import_file_ext;
                    $filedest = '../uploads/' . $image_storage_name;
                    move_uploaded_file($filetmplocation, $filedest);

                    echo "destroy6<br>";
                    // add to database the user and their image file
                    $username = $_SESSION['username'];
                    echo "$username<br>";
                    $sql = "INSERT INTO posts (username, picture) VALUES ('$username', '$image_storage_name')";
                    echo "destroy8<br>";
                    $conn->query($sql);
                    echo "destroy9<br>";
                    header("location: post.php?success");
                    exit();
                } else {
                    echo "file is too large";
                }
            } else {
                echo "not a valid file extension";
            }
        } catch (PDOException $e){
            echo $e->getMessage();
        }
    } else {
        header("Location: ../user/post.php?failed");
        exit();
    }
?>