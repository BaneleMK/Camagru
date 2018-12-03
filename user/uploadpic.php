<?php
    if (isset($_POST['submit'])) {
        try {
            require_once("../config/setup.php");
            session_start();

            echo 'one';
            $webcamimage = 0;
            if (isset($_FILES['file'])) {
                echo '2';
                $file = $_FILES['file'];
                $filename = $_FILES['file']['name'];
                $filetmplocation = $_FILES['file']['tmp_name'];
                $filesize = $_FILES['file']['size'];
                $fileerror = $_FILES['file']['error'];

                $explodedname = explode('.', $filename);
                $import_file_ext = end($explodedname);
                $file_ext = array('png', 'jpeg', 'jpg');
            } else if ($_POST['webcampic'] != 'empty') {
                echo '3<br>';
                $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $_POST['webcampic']));
                $import_file_ext = 'png';
                $image_storage_name = "../uploads/" . uniqid('', true) . '.' . $import_file_ext;
                $filetmplocation = "$image_storage_name";
                file_put_contents($filetmplocation, $data);
                $filedest = realpath($filetmplocation);
                echo $filedest . "<br><br>" . $image_storage_name . "<br><br>". $filetmplocation . "<br><br>";
                $webcamimage = 1;
            } else {
                echo 'what are you doing here?';
                exit();
            } 
            echo 'three';
            if ($_POST['sticker'] == 'none') {
                header("Location: ../user/post.php?nosticker");
                exit();
            } else if ($webcamimage == 1 || in_array($import_file_ext, $file_ext)) {
                if ($webcamimage == 1 || $filesize <= 10000000) {
                    if ($webcamimage == 0) {
                        $image_storage_name = uniqid('', true) . '.' . $import_file_ext;
                        $filedest = '../uploads/' . $image_storage_name;
                        move_uploaded_file($filetmplocation, $filedest);
                    }
                    
                    echo "$filedest" . "<br>";
                    echo "$filetmplocation" . "<br>";
                    
                    // get dimentions for dst and src
                    list($dst_width, $dst_height, $dst_type, $dst_attr) = getimagesize(realpath("$filedest"));
                    
                    echo "dst Image width " .  $dst_width . "<br>";
                    echo "dst Image height " . $dst_height . "<br>";
                    echo "dst Image type " .   $dst_type . "<br>";
                    echo "dst Attribute " .    $dst_attr . "<br><br>";
                    
                    $stickerdst = $_POST['sticker'];
                    echo "$stickerdst" . "<br>";
                    list($src_width, $src_height, $src_type, $src_attr) = getimagesize("$stickerdst");

                    echo "src Image width " .  $src_width . "<br>";
                    echo "src Image height " . $src_height . "<br>";
                    echo "src Image type " .   $src_type . "<br>";
                    echo "src Attribute " .    $src_attr . "<br><br>";

                    $image = imagecreatefrompng("$filedest");
                    $stickerimage = imagecreatefrompng("$stickerdst");

                    imagecopyresized($image, $stickerimage, 0, 0, 0, 0, $dst_width, $dst_height , $src_width, $src_height);
                    header("content-type: image/png");
                    imagepng($image, $filedest);
                    //unlink($filedest);
                    /*if ($webcamimage == 1) {
                        unlink($filetmplocation);
                    }*/
                    //echo "destroy6<br>";
                    // add to database the user and their image file
                    
                    $username = $_SESSION['username'];
                    $sql = "INSERT INTO posts (username, picture) VALUES ('$username', '$image_storage_name')";
                    $conn->query($sql);
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