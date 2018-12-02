<?php

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Profile</title>
        <link rel="stylesheet" href="../css/mystyles.css">      
    </head>
    <body>
        <nv>
            <nvli style="float: left;"><a href="../index.php">Home</a></nvli>
            <?php
            if (!isset($_SESSION['id']))
            {
                echo '
                    <nvli><a href="../signup/signup.php">Sign up</a></nvli>
                    <nvli><a href="../login/login.php">Login</a></nvli>';
            }
            else
            {
                echo '
                <nvli><a href="../login/logout.php">Logout</a></nvli>
                <nvli><a class=active href="post.php">Post</a></nvli>
                <nvli><a href="viewposts.php">View Posts</a></nvli>
                <nvli><a href="profile.php">' . $_SESSION['username'] . '</a></nvli>';
            }
            ?>
        </nv>
        <div class="mainbox">
            <div class="subbox" style="flex-direction: column;">
                <div class="camtopflexbox">
                    \-CamBooth-/
                    <nvcam id=nvcam>
                        <nvli style="float: left;"><a id=webcam>webcam</a></nvli>
                        <nvli><a id=picupload>upload picture</a></nvli>
                    </nvcam>
                </div>
                <div class="cammidflexbox">
                    <div class="separationflexbox">
                    <form action=uploadpic.php id=submitform method=POST enctype=multipart/form-data>
                        <div id="picmethod">
                            <video id="video" name=file>
                                There was an error in getting the camera feed.<br>
                            </video>
                        </div>
                    </div>
                    <div class="separationflexbox">
                        <div class="stickerflexbox">
                        <select name="sticker" form=submitform>
                            <option value="none">pick any sticker</option>
                            <option value="../Resources/heart_off.png">black heart</option>
                            <option value="../Resources/Sansdad.png">skelly</option>
                            <option value="../Resources/facefurr.png">facefurr</option>
                            <option value="../Resources/BIGSALE.png">BIGSALE</option>
                            <option value="../Resources/VeryAngrtBird.png">Angrybird</option>
                            <option value="../Resources/Christmasf1.png">Christmas frame 1</option>
                            <option value="../Resources/Christmasf2.png">Christmas frame 2</option>
                            <option value="../Resources/Christmasf3.png">Christmas frame 3</option>
                        </select>                        
                        </div>
                    </div>
                </div>
                <div class="cambotflexbox">
                    <button id="camshot">take pic</button>
                    <!--<button id="clear">clear pics</button>
                    <select id="effect">
                        <option value="none">normal</option>
                        <option value="grayscale(100%)">grayscale</option>
                        <option value="sepia(100%)">sepia</option>
                        <option value="invert(100%)">invert</option>
                        <option value="blur(5px)">blur</option>
                    </select>-->
                    <button id="submit" type=submit name="submit">submit</button>
                </div>
                <div class="campicflexbox">
                    <input type=text name=webcampic id=base64imglink value="empty"><!-- style="display:none;">-->
                    <canvas id="canvas"><!-- style="display:none;">-->
                    
                    </canvas>
                    <!--<div id="photos">
                    
                    </div>-->
                </div>
                <script src="../js/postcam.js"></script>
            </form>
            </div>   
        </div>
    </body>
</html>