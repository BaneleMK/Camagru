
<?php
    
    session_start();
    
    require_once("../config/setup.php");

    if (isset($_POST['submit'])) {
        $username = $_SESSION['username'];
        $query = $conn->prepare("SELECT * FROM users WHERE username='$username'");
        $query->execute();
        $row = $query->fetch();
        if ($_POST['password'] != $_POST['password_vr']){
            require_once("../login/logout.php");    
            header("Location: resetpassword.php?signup=pwderror");
        } else {
            $newpassword = hash('whirlpool', $_POST['password']);
            if ($row['password'] == $newpassword ) {
                require_once("../login/logout.php");    
                header("Location: ../login/login.php?login=samepassword");
                exit();
            } else {
                $sql = "UPDATE users SET password = '$newpassword', verificationcode = 0 WHERE username = '$username'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                require_once("../login/logout.php");    
                header("Location: ../login/login.php?login=successfulpwdreset");
                exit();
            }
        }
    } else {
        header("Location: ../index.php?redir");
        exit();
    }
?>