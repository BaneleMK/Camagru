<?php
    if (isset($_POST['submit'])) {
        try {
            require_once("../config/setup.php");
            session_start();

            echo 'one';
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
            } else if ($_TEXT['webcampic'] != 'empty') {
                echo '3';
                echo base64_decode($_TEXT['webcampic']);
            } else {
                echo 'what are you doing here?';
            }
            if ($_POST['sticker'] == 'none') {
                //echo 'not none...anything but none';
                exit();
            } else if (in_array($import_file_ext, $file_ext)) {
                if ($filesize <= 10000000) {
                    $image_storage_name = uniqid('', true) . '.' . $import_file_ext;
                    $filedest = '../uploads/' . $image_storage_name;
                    move_uploaded_file($filetmplocation, $filedest);
                    
                    //echo "$filedest" . "<br>";
                    
                    // get dimentions for dst and src
                    list($dst_width, $dst_height, $dst_type, $dst_attr) = getimagesize("$filedest");
                    
                    //echo "dst Image width " .  $dst_width . "<br>";
                    //echo "dst Image height " . $dst_height . "<br>";
                    //echo "dst Image type " .   $dst_type . "<br>";
                    //echo "dst Attribute " .    $dst_attr . "<br><br>";
                    
                    $stickerdst = $_POST['sticker'];
                    //echo "$stickerdst" . "<br>";
                    list($src_width, $src_height, $src_type, $src_attr) = getimagesize("$stickerdst");

                    //echo "src Image width " .  $src_width . "<br>";
                    //echo "src Image height " . $src_height . "<br>";
                    //echo "src Image type " .   $src_type . "<br>";
                    //echo "src Attribute " .    $src_attr . "<br><br>";

                    $image = imagecreatefrompng("$filedest");
                    $stickerimage = imagecreatefrompng("$stickerdst");

                    imagecopyresized($image, $stickerimage, 0, 0, 0, 0, $dst_width, $dst_height , $src_width, $src_height);
                    header("content-type: image/png");
                    imagepng($image, $filedest);
                    //unlink($filedest);
                    
                    //echo "destroy6<br>";
                    // add to database the user and their image file
                    $username = $_SESSION['username'];
                    $sql = "INSERT INTO posts (username, picture) VALUES ('$username', '$image_storage_name')";
                    $conn->query($sql);
                    header("location: post.php?success");
                    exit();
                } else {
                    //echo "file is too large";
                }
            } else {
                //echo "not a valid file extension";
            }
        } catch (PDOException $e){
            //echo $e->getMessage();
        }
    } else {
        header("Location: ../user/post.php?failed");
        exit();
    }
?>