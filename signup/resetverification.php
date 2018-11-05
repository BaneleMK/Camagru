
<?php
    require_once("../login/logout.php");    
    session_start();
    
    require_once("../config/setup.php");

    if (isset($_GET['username']) && isset($_GET['code'])) {
        $username = $_GET['username'];
        $code = $_GET['code'];
        $query = $conn->prepare("SELECT * FROM users WHERE username='$username'");
        $query->execute();
        $row = $query->fetch();
        $_SESSION['username'] = $row['username'];
        if ($row['username'] == $username && $row['verificationcode'] == $code && $code != 0) {
            header("Location: resetpassword.php");
            exit();
        } else {
            header("Location: ../index.php");
            exit();
        }
    } else {
        header("Location: index.php?redir");
        exit();
    }
?>