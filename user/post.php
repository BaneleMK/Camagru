<?php

session_start();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Profile</title>
        <link rel="stylesheet" href="../css/mystyles.css">      
    </head>
    <body bgcolor=red>
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
                <nvli><a href="profile.php">' . $_SESSION['username'] . '</a></nvli>';
            }
            ?>
        </nv>
        <div class="mainbox">
            <div class="subbox" style="flex-direction: column;">
                <div class="camtopflexbox">
                    \-CamBooth-/
                </div>

                <div class="cammidflexbox">
                    <video id="video">
                        There was an error in getting the camera feed.<br>
                    </video>
                    
                </div>

                <div class="cambotflexbox">
                    <button id="camshot">take pic</button>
                    <button id="clear">clear pics</button>
                    <select id="effect">
                        <option value="none">normal</option>
                        <option value="grayscale(100%)">grayscale</option>
                        <option value="sepia(100%)">sepia</option>
                        <option value="invert(100%)">invert</option>
                        <option value="blur(5px)">blur</option>
                    </select>
                </div>

                <div class="campicflexbox">
                    <canvas id="canvas" style="display:none;">
                    
                    </canvas>
                    <div id="photos">
                    
                    </div>
                </div>

                <script src="../js/postcam.js"></script>
            </div>   
        </div>
    </body>
</html>