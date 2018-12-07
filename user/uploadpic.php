<?php
    if (isset($_POST['submit'])) {
        try {
            require_once("../config/setup.php");
            session_start();

            //echo 'one';
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
                $image_storage_name = uniqid('', true) . '.' . $import_file_ext;
                $filetmplocation = "../uploads/" . uniqid('', true) . '.' . $import_file_ext;
                //$filetmplocation = "$image_storage_name";
                file_put_contents($filetmplocation, $data);
                $filedest = realpath($filetmplocation);
                echo $filedest . "<br><br>" . $image_storage_name . "<br><br>". $filetmplocation . "<br><br>";
                $webcamimage = 1;
            } else {
                echo 'what are you doing here?';
                exit();
            } 
            echo 'three<br>';
            if ($_POST['sticker0'] == 'none' && $_POST['sticker1'] == 'none' && $_POST['sticker3'] == 'none') {
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
                    
                    $stickerdst0 = $_POST['sticker0'];
                    $stickerdst1 = $_POST['sticker1'];
                    $stickerdst2 = $_POST['sticker2'];
                    //echo "$stickerdst0" . "<br>";
                    
                    $image = imagecreatefrompng("$filedest");
                    
                    if ($_POST['sticker0'] != 'none') {
                        $stickerimage0 = imagecreatefrompng("$stickerdst0");
                        list($src_width0, $src_height0, $src_type0, $src_attr0) = getimagesize("$stickerdst0");
                        /*
                        echo "0src Image width " .  $src_width0 . "<br>";
                        echo "0src Image height " . $src_height0 . "<br>";
                        echo "0src Image type " .   $src_type0 . "<br>";
                        echo "0src Attribute " .    $src_attr0 . "<br><br>";
                        */
                        imagecopyresized($image, $stickerimage0, 0, 0, 0, 0, $dst_width, $dst_height , $src_width0, $src_height0);
                    }
                    //echo "$stickerdst2" . "<br>";

                    if ($_POST['sticker1'] != 'none') {
                        $stickerimage1 = imagecreatefrompng("$stickerdst1");
                        list($src_width1, $src_height1, $src_type1, $src_attr1) = getimagesize("$stickerdst1");
                        /*
                        echo "1src Image width " .  $src_width1 . "<br>";
                        echo "1src Image height " . $src_height1 . "<br>";
                        echo "1src Image type " .   $src_type1 . "<br>";
                        echo "1src Attribute " .    $src_attr1 . "<br><br>";
                        */
                        imagecopyresized($image, $stickerimage1, 0, 0, 0, 0, $dst_width, $dst_height , $src_width1, $src_height1);
                    }
                    //echo "$stickerdst1" . "<br>";
                    
                    if ($_POST['sticker2'] != 'none') {
                        $stickerimage2 = imagecreatefrompng("$stickerdst2");
                        list($src_width2, $src_height2, $src_type2, $src_attr2) = getimagesize("$stickerdst2");
                        /*
                        echo "2src Image width " .  $src_width2 . "<br>";
                        echo "2src Image height " . $src_height2 . "<br>";
                        echo "2src Image type " .   $src_type2 . "<br>";
                        echo "2src Attribute " .    $src_attr2 . "<br><br>";
                        */
                        imagecopyresized($image, $stickerimage2, 0, 0, 0, 0, $dst_width, $dst_height , $src_width2, $src_height2);
                    }

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