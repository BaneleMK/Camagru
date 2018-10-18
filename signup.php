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
            <td><input type=submit></td>
        </tr>
    </table>
    </form>
    </div>
</body>
</html>