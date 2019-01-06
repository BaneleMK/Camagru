<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Trender-Profile</title>
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
                <nvli><a href="post.php">Post</a></nvli>
                <nvli><a href="viewposts.php">View Posts</a></nvli>
                <nvli><a class=active href="profile.php">' . $_SESSION['username'] . '</a></nvli>';
            }
            ?>
        </nv>
        <div class="mainbox">
            <div class="subbox">
                    
                <div class="picbox">
                    <div class="formflexbox" style="width:55%; height:600px; background-color: #FFFFFF">
                        <form action="profileinfo.php" method="POST">
                            <hr/>
                            <table class=table>
                                </tr>
                                    <td>Gender:</td>
                                    <td><select name="sexuality">
                                        <option value="Other">Other</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select></td>
                                </tr>
                                <tr>
                                    <td>Sexuality</td>
                                    <td><select name="sexuality">
                                        <option value="biosexual">Biosexual</option>
                                        <option value="homosexual">Homosexual</option>
                                        <option value="hetrosexual">Hetrosexual</option>
                                    </select></td>
                                </tr>
                                <tr>
                                    <td>Location</td>
                                    <td><input type="text" name="location" required></td>
                                </tr>
                                <tr>
                                    <td>Tag-1</td>
                                    <td><input type="text" name="tags1" value="Empty" required></td>
                                </tr>
                                <tr>
                                    <td>Tag-2</td>
                                    <td><input type="text" name="tags2" value="Empty" required></td>
                                </tr>
                                <tr>
                                    <td>Tag-3</td>
                                    <td><input type="text" name="tags3" value="Empty" required></td>
                                </tr>
                                <tr>
                                    <td>Tag-4</td>
                                    <td><input type="text" name="tags4" value="Empty" required></td>
                                </tr>
                                <tr>
                                    <td>Tag-5</td>
                                    <td><input type="text" name="tags5" value="Empty" required></td>
                                </tr>

                                <tr>
                                    <td><button type="submit" name="submit">SUBMIT</button></td>
                                </tr>
                            </table>
                        </form>
                        </div>
                        </div>
                        <?php
                            include '../messages/phpboxmessages.php';
                        ?>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </body>
</html>