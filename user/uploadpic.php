<?php

    function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){
        // creating a cut resource
        $cut = imagecreatetruecolor($src_w, $src_h);

        // copying relevant section from background to the cut resource
        imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
    
        // copying relevant section from watermark to the cut resource
        imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
    
        // insert cut resource to destination image
        imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
    }

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

            if ($_POST['sticker'] == 'none') {
                echo 'not none...anything but none';
                exit();
            } else if (in_array($import_file_ext, $file_ext)) {
                if ($filesize <= 10000000) {
                    
                    echo "destroy5<br>";
                    $image_storage_name = uniqid('', true) . '.' . $import_file_ext;
                    $filedest = '../uploads/' . $image_storage_name;
                    move_uploaded_file($filetmplocation, $filedest);
                    
                    echo "$filedest" . "<br>";
                    
                    // get dimentions for dst and src
                    list($dst_width, $dst_height, $dst_type, $dst_attr) = getimagesize("$filedest");
                    
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

                    //unlink($filedest);
                    header("content-type: image/jpeg");
                    $image = imagecreate($dst_width, $dst_height) or die("cannot something something");
                    $canvas = imagecolorallocate($image, 245, 245, 245);
                    $dst = imagecreatefromjpeg($filedest);
                    imagecopy($image, $dst, 0, 0, 0, 0, $dst_width, $dst_height);
                    imagejpeg($image);
                    imagedestroy($image);

                    //$src = imagecreatfromjpeg($stickerdst);
                    
                    /*$src = imagecreatefromjpeg($stickerdst);
                    $dst = imagecreatefromjpeg($filedest);
                    imagecopymerge_alpha($dst, $src, 0, 0, 0, 0, $src_width, $src_height, 100);
                    //move_uploaded_file($filetmplocation, $dst);
                    header("content-type: image/jpeg");
                    imagepng($dst);
                    //imagedestroy($dst);

                    */
                    
                    /*
                    echo "destroy6<br>";
                    // add to database the user and their image file
                    $username = $_SESSION['username'];
                    echo "$username<br>";
                    $sql = "INSERT INTO posts (username, picture) VALUES ('$username', '$image_storage_name')";
                    echo "destroy8<br>";
                    $conn->query($sql);
                    echo "destroy9<br>";
*/
                    //header("location: post.php?success");
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