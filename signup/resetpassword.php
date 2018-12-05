<?php    
    session_start();
?>

<html>
<head>
    <title>Trender-password reset</title>
    <link rel="stylesheet" href="../css/mystyles.css">
</head>
<body bgcolor=red>

    <nv>
        <nvli style="float: left;"><a href="../index.php">Home</a></nvli>
        <nvli><a href="signup.php">Sign up</a></nvli>
        <nvli><a href="../login/login.php">Login</a></nvli>';
    </nv>
    <div class="mainbox" style="align-items: center; justify-content: center;">
    <div class="formflexbox">
    <!-- when it comes to methods you have two

        one of them is GET which passes the infomation to the php file and makes
        the information being passsesd visible on the url.

        the other one is POST which does the same except it does not show on the url
        good for stuff like passwords.
    -->
    <form action="resetpasswordinfo.php?username=$_GET[\'username\']" method="POST">
    <table>
        <tr>
            <td>password:</td>
            <td><input type="password" name="password" required></td>
        </tr>
        <tr>
            <td>repeat password:</td>
            <td><input type="password" name="password_vr" required></td>
        </tr>
        <tr>
            <td><button type="submit" name="submit">submit</button></td>
        </tr>
    </table>
    </form>
    </br>
    </br>
    </div>
    <?php
        include '../messages/phpboxmessages.php';
    ?>
    </div>
    <br/>
</body>
</html>