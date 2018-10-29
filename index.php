<?php

session_start();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Homepage</title>
        <link rel="stylesheet" href="mystyles.css">        
    </head>
    <body bgcolor=red>
        <nv>
            <nvli style="float: left;"><a class=active href="index.php">Home</a></nvli>
            <?php

            if (!isset($_SESSION['id']))
            {
                echo '
                    <nvli><a href="signup.php">sign up</a></nvli>
                    <nvli><a href="login.php">login</a></nvli>';
            }
            else
            {
                echo '
                <nvli><a href="logout.php">logout</a></nvli>
                <nvli><a href="profile.php">profile</a></nvli>';
            }
            ?>
        </nv>
        <div class="mainbox">
            <div class="subbox">
                <div class="optionbox">
                    
                </div>
                <div class="picbox">
                    
                </div>
            </div>   
        </div>
    </body>
</html>