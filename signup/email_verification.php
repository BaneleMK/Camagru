<?php
    
    session_start();
    
    require_once("../config/setup.php");
    require_once("../functions/sanitize.php");

    if (isset($_GET['username']) && isset($_GET['verificationcode'])) {
        $username = sanitize($_GET['username']);
        $code = sanitize($_GET['verificationcode']);
        $stmt = $conn->prepare("SELECT * FROM users WHERE username='$username'");
        $stmt->execute();
        $row = $stmt->fetch();
        if ($row['username'] == $username && $row['verificationcode'] == $code) {
            if ($row['user_status'] == 'registered') {
                header("Location: ../login/login.php?login=registered");
                exit();
            } else {
                $sql = "UPDATE users SET user_state = 'registered', verificationcode = 0 WHERE username = '$username'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                header("Location: ../login/login.php?login=Successfulverif");
                exit();
            }
        } else {
            header("Location: ../login/login.php?login=unexpectederror");
            exit();
        }
    } else {
        header("Location: ../index.php");
        exit();
    }

?>