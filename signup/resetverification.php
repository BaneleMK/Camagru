<?php
    session_start();
    
    include_once("../functions/sanitize.php");
    require_once("../config/setup.php");

    if (isset($_GET['username']) && isset($_GET['code'])) {
        $username = sanitize($_GET['username']);
        $code = sanitize($_GET['code']);
        $query = $conn->prepare("SELECT * FROM users WHERE username='$username'");
        $query->execute();
        $row = $query->fetch();
        $_SESSION['username'] = $row['username'];
        if ($row['username'] == $username && $row['verificationcode'] == $code && $code != 0) {
            header("Location: resetpassword.php");
            exit();
        } else {
            session_unset();
            header("Location: ../index.php?error");
            exit();
        }
    } else {
        header("Location: index.php?redir");
        exit();
    }
?>