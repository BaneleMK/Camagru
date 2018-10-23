<html>
<head>
    <title>sign up</title>
    <style>
        .form{
            background-color = gray;
        }
    </style>
</head>
<body>

    <div class="form">
    <!-- when it comes to methods you have two

        one of them is GET which passes the infomation to the php file and makes
        the information being passsesd visible on the url.

        the other one is POST which does the same except it does not show on the url
        good for stuff like passwords.
    -->
    <form action="signupinfo.php" method="POST">
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
</body>
</html>