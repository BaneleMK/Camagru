<?php    
    session_start();
?>

<html>
<head>
    <title>Trender-login</title>
    <link rel="stylesheet" href="../css/mystyles.css">
</head>
<body bgcolor=red>

    <nv>
        <nvli style="float: left;"><a href="../index.php">Home</a></nvli>
        <nvli><a href="../signup/signup.php">sign up</a></nvli>
        <nvli><a class=active href="login.php">login</a></nvli>
    </nv>
    <div class="mainbox" style="align-items: center; justify-content: center;">
    <div class="formflexbox">
    <!-- when it comes to methods you have two

        one of them is GET which passes the infomation to the php file and makes
        the information being passsesd visible on the url.

        the other one is POST which does the same except it does not show on the url
        good for stuff like passwords.
    -->
    <form action="log_in_info.php" method="POST">
    <table>
        <tr>
            <td>username:</td>
            <td><input type="text" name="username" required></td>
        </tr>
        <tr>
            <td>password:</td>
            <td><input type="password" name="password" required></td>
        </tr>
        <tr>
            <td><button type="submit" name="submit">login</button></td>
        </tr>
    </table>
    </form>
    </br>
    </br>
    <a href="../signup/forgotpassword.php" name="passord_reset">Forgot password?</a>
    </div>
    <?php
        include '../messages/phpboxmessages.php';
    ?>
    </div>
    <br/>
</body>
</html>