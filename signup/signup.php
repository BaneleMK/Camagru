<?php    
    session_start();
?>

<html>
<head>
    <title>Trender-sign up</title>
    <link rel="stylesheet" href="../css/mystyles.css">
</head>
<body bgcolor=red>
    <nv>
        <nvli style="float: left;"><a href="../index.php">Home</a></nvli>
        <nvli><a class=active href="signup.php">Sign up</a></nvli>
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
    <form action="signupinfo.php" method="POST">
    <table class=table>
        <tr>
            <td>username:</td>
            <td><input type="text" name="username" required></td>
        </tr>
        <tr>
            <td>password:</td>
            <td><input type="password" name="password" required></td>
        </tr>
        <tr>
            <td>password verification:</td>
            <td><input type="password" name="password_vr" required></td>
        </tr>
        <tr>
            <td>email:</td>
            <td><input type="text" name="email" required></td>
        </tr>
        <tr>
            <td>firstname:</td>
            <td><input type="text" name="firstname" required></td>
        </tr>
        <tr>
            <td>lastname:</td>
            <td><input type="text" name="lastname" required></td>
        </tr>
        <tr>
            <td><button type="submit" name="submit">Sign up</button></td>
        </tr>
    </table>
    </form>
    </div>
        <?php
            include '../messages/phpboxmessages.php';
        ?>
    </div>
    <br/>
</body>
</html>