<?php    
    session_start();
?>

<html>
<head>
    <title>login</title>
    <link rel="stylesheet" href="mystyles.css">
</head>
<body bgcolor=red>
    <nv>
        <nvli style="float: left;"><a href="index.php">Home</a></nvli>
        <nvli><a href="signup.php">sign up</a></nvli>
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
    <form action="forgotemailinfo.php" method="POST">
    <table>
        <tr>
            <td>email:</td>
            <td><input type="text" name="email" required></td>
        </tr>
        <tr>
            <td><button type="submit" name="submit">login</button></td>
        </tr>
    </table>
    </form>
    </div>
    <?php
        if (isset($_GET['login'])) {
            if ($_GET['login'] == "Error") {
                echo '
                <div class="failflexbox">
                <form action="signupinfo.php" method="POST">
                <table class=table>
                    <tr>
                        <td>Unknown email.</td>
                    </tr>
                </table>
                </form>
                </div>';
            } else if ($_GET['login'] == "unexpectederror") {
                echo '
                <div class="failflexbox">
                <form action="signupinfo.php" method="POST">
                <table class=table>
                    <tr>
                        <td>Something went wrong on ourside, please try again. if error persists please contact support.</td>
                    </tr>
                </table>
                </form>
                </div>';
            } else if ($_GET['login'] == "empty") {
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
            } else if ($_GET['login'] == "Successful") {
                echo '
                <div class="passflexbox">
                <form action="signupinfo.php" method="POST">
                <table class=table>
                    <tr>
                        <td>A reset message has been sent to your email</td>
                    </tr>
                </table>
                </form>
                </div>';
            } else if ($_GET['login'] == "unregistered") {
                echo '
                <div class="failflexbox">
                <form action="signupinfo.php" method="POST">
                <table class=table>
                    <tr>
                        <td>Your account is not verified yet, please check your mail to verify it!</td>
                    </tr>
                </table>
                </form>
                </div>';
            } else if ($_GET['login'] == "samepassword") {
                echo '
                <div class="failflexbox">
                <form action="signupinfo.php" method="POST">
                <table class=table>
                    <tr>
                        <td>lol, why are you putting in the same password. might as well keep on using it</td>
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