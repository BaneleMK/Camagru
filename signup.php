<?php    
    session_start();
?>

<html>
<head>
    <title>sign up</title>
    <link rel="stylesheet" href="mystyles.css">
</head>
<body bgcolor=red>
    <nv>
        <nvli style="float: left;"><a href="index.php">Home</a></nvli>
        <nvli><a class=active href="signup.php">sign up</a></nvli>
        <nvli><a href="login.php">login</a></nvli>

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
            if (isset($_GET['signup'])) {
                if ($_GET['signup'] == "email") {
                    echo '
                    <div class="failflexbox">
                    <form action="signupinfo.php" method="POST">
                    <table class=table>
                        <tr>
                            <td>Email provided has invalid format.</td>
                        </tr>
                    </table>
                    </form>
                    </div>';
                } else if ($_GET['signup'] == "pwderror") {
                    echo '
                    <div class="failflexbox">
                    <form action="signupinfo.php" method="POST">
                    <table class=table>
                        <tr>
                            <td>Passwords must match.</td>
                        </tr>
                    </table>
                    </form>
                    </div>';
                } else if ($_GET['signup'] == "empty") {
                    echo '
                    <div class="failflexbox">
                    <form action="signupinfo.php" method="POST">
                    <table class=table>
                        <tr>
                            <td>Missing spaces.</td>
                        </tr>
                    </table>
                    </form>
                    </div>';
                } else if ($_GET['signup'] == "names") {
                    echo '
                    <div class="failflexbox">
                    <form action="signupinfo.php" method="POST">
                    <table class=table>
                        <tr>
                            <td>both first and last names must have only letters.</td>
                        </tr>
                    </table>
                    </form>
                    </div>';
                } else if ($_GET['signup'] == "username") {
                    echo '
                    <div class="failflexbox">
                    <form action="signupinfo.php" method="POST">
                    <table class=table>
                        <tr>
                            <td>Usersnames characters are a-z A-Z 0-9 and underscore \'_\'.</td>
                        </tr>
                    </table>
                    </form>
                    </div>';
                } else if ($_GET['signup'] == "admin") {
                    echo '
                    <div class="failflexbox">
                    <form action="signupinfo.php" method="POST">
                    <table class=table>
                        <tr>
                            <td>Username cant be Admin or admin.</td>
                        </tr>
                    </table>
                    </form>
                    </div>';
                } else if ($_GET['signup'] == "emailexist") {
                    echo '
                    <div class="failflexbox">
                    <form action="signupinfo.php" method="POST">
                    <table class=table>
                        <tr>
                            <td>email already exists, try another one.</td>
                        </tr>
                    </table>
                    </form>
                    </div>';
                } else if ($_GET['signup'] == "usernameexist") {
                    echo '
                    <div class="failflexbox">
                    <form action="signupinfo.php" method="POST">
                    <table class=table>
                        <tr>
                            <td>username already exists, try another one.</td>
                        </tr>
                    </table>
                    </form>
                    </div>';
                } else if ($_GET['signup'] == "faulty") {
                    echo '
                    <div class="failflexbox">
                    <form action="signupinfo.php" method="POST">
                    <table class=table>
                        <tr>
                            <td>Something went wrong on oursides, please try again later.</td>
                        </tr>
                    </table>
                    </form>
                    </div>';
                } else if ($_GET['signup'] == "Successful") {
                    echo '
                    <div class="failflexbox">
                    <form action="signupinfo.php" method="POST">
                    <table class=table>
                        <tr>
                            <td>Account creation was Successful, please verify your account.</td>
                        </tr>
                    </table>
                    </form>
                    </div>';
                }
            }
            ?>
    </div>
    <br/>
</body>
</html>