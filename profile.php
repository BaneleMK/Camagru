<?php

session_start();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Profile</title>
        <link rel="stylesheet" href="mystyles.css">        
    </head>
    <body bgcolor=red>
        <nv>
            <nvli style="float: left;"><a href="index.php">Home</a></nvli>
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
                <nvli><a class=active href="profile.php">' . $_SESSION['username'] . '</a></nvli>';
            }
            ?>
        </nv>
        <div class="mainbox">
            <div class="subbox">
                    
                <div class="picbox">
                    <h1>Profile construction progress</br></br>Its not a joke</h1>
                </div>
            </div>   
        </div>
    </body>
</html>