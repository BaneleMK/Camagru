<?php
if (isset($_GET['login'])) {
    if ($_GET['login'] == "Error") {
        echo '
        <div class="failflexbox">
        <table class=table>
            <tr>
                <td>Unknown email.</td>
            </tr>
        </table>
        </div>';
    } else if ($_GET['login'] == "empty") {
        echo '
        <div class="failflexbox">
        <table class=table>
            <tr>
                <td>Missing spaces.</td>
            </tr>
        </table>
        </div>';
    } else if ($_GET['login'] == "unregistered") {
        echo '
        <div class="failflexbox">
        <table class=table>
            <tr>
                <td>Your account is not verified yet, please check your mail to verify it!</td>
            </tr>
        </table>
        </div>';
    } else if ($_GET['login'] == "samepassword") {
        echo '
        <div class="failflexbox">
        <table class=table>
            <tr>
                <td>lol, why are you putting in the same password. might as well keep on using it</td>
            </tr>
        </table>
        </div>';
    } else if ($_GET['login'] == "successfulpwdreset") {
        echo '
        <div class="passflexbox">
        <table class=table>
            <tr>
                <td>Your password has been reset, try it</td>
            </tr>
        </table>
        </div>';
    } else if ($_GET['login'] == "userunknown") {
        echo '
        <div class="failflexbox">
        <table class=table>
            <tr>
                <td>incorrect password and/or username.</td>
            </tr>
        </table>
        </div>';
    } else if ($_GET['login'] == "unexpectederrorreg") {
        echo '
        <div class="failflexbox">
        <table class=table>
            <tr>
                <td>Something went wrong on ourside with storing. if error persists please contact support.</td>
            </tr>
        </table>
        </div>';
    } else if ($_GET['login'] == "Successfulverif") {
        echo '
        <div class="passflexbox">
        <table class=table>
            <tr>
                <td>Your account is now verified!<br/>You may login</td>
            </tr>
        </table>
        </div>';
    } else if ($_GET['login'] == "registered") {
        echo '
        <div class="failflexbox">
        <table class=table>
            <tr>
                <td>Your account has already been verified!<br/>You may login</td>
            </tr>
        </table>
        </div>';
    }
} else if (isset($_GET['signup'])) {
    if ($_GET['signup'] == "invalidemail") {
        echo '
        <div class="failflexbox">
        <table class=table>
            <tr>
                <td>Email provided has invalid format.</td>
            </tr>
        </table>
        </div>';
    } else if ($_GET['signup'] == "pwderror") {
        echo '
        <div class="failflexbox">
        <table class=table>
            <tr>
                <td>Passwords must match.</td>
            </tr>
        </table>
        </div>';
    } else if ($_GET['signup'] == "empty") {
        echo '
        <div class="failflexbox">
        <table class=table>
            <tr>
                <td>Missing spaces.</td>
            </tr>
        </table>
        </div>';
    } else if ($_GET['signup'] == "names") {
        echo '
        <div class="failflexbox">
        <table class=table>
            <tr>
                <td>both first and last names must have only letters.</td>
            </tr>
        </table>
        </div>';
    } else if ($_GET['signup'] == "username") {
        echo '
        <div class="failflexbox">
        <table class=table>
            <tr>
                <td>Usersnames characters are a-z A-Z 0-9 and underscore \'_\'.</td>
            </tr>
        </table>
        </div>';
    } else if ($_GET['signup'] == "admin") {
        echo '
        <div class="failflexbox">
        <table class=table>
            <tr>
                <td>Username cant be Admin or admin.</td>
            </tr>
        </table>
        </div>';
    } else if ($_GET['signup'] == "emailexist") {
        echo '
        <div class="failflexbox">
        <table class=table>
            <tr>
                <td>email already exists, try another one.</td>
            </tr>
        </table>
        </div>';
    } else if ($_GET['signup'] == "usernameexist") {
        echo '
        <div class="failflexbox">
        <table class=table>
            <tr>
                <td>username already exists, try another one.</td>
            </tr>
        </table>
        </div>';
    } else if ($_GET['signup'] == "faulty") {
        echo '
        <div class="failflexbox">
        <table class=table>
            <tr>
                <td>oops bad catch Something went wrong on oursides, please try again later.</td>
            </tr>
        </table>
        </div>';
    } else if ($_GET['signup'] == "Successfulcreation") {
        echo '
        <div class="failflexbox">
        <table class=table>
            <tr>
                <td>Account creation was Successful, please verify your account.</td>
            </tr>
        </table>
        </div>';
    }
} else if (isset($_GET['reset'])) {
    if ($_GET['reset'] == "invalidemail") {
        echo '
        <div class="failflexbox">
        <table class=table>
            <tr>
                <td>No such account exist.</td>
            </tr>
        </table>
        </div>';
    } else if ($_GET['reset'] == "successfulreset") {
        echo '
        <div class="passflexbox">
        <table class=table>
            <tr>
                <td>A reset message has been sent to your email</td>
            </tr>
        </table>
        </div>';
    }
}
?>