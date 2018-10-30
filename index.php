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
                    <nvli><a href="signup.php">Sign up</a></nvli>
                    <nvli><a href="login.php">Login</a></nvli>';
            }
            else
            {
//                <nvli><a href="profile.php">' . $_POST['$username'] . '</a></nvli>';
                echo '
                <nvli><a href="logout.php">Logout</a></nvli>
                <nvli><a href="profile.php">Profile</a></nvli>';
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