<?php
    
    session_start();
    
    require_once("../config/setup.php");

    if (isset($_POST['newpassword'])) {
        $username = $_SESSION['username'];
        $query = $conn->prepare("SELECT * FROM users WHERE username='$username'");
        $query->execute();
        $row = $query->fetch();
        if ($_POST['newpassword'] != $_POST['newpassword_vr']){
            header("Location: profile.php?signup=pwderror");
            exit();
        } else if ($_POST['newpassword'] == $row['password']) {
            header("Location: profile.php?login=samepassword");
            exit();
        } else if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/", $_POST['newpassword'])) {
            header("Location: profile.php?signup=pwdreq");
            exit();
        } else {
            $newpassword = hash('whirlpool', $_POST['newpassword']);
            if ($row['password'] == $newpassword) {
                header("Location: profile.php?login=samepassword");
                exit();
            } else {
                $sql = "UPDATE users SET password = '$newpassword' WHERE username = '$username'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                header("Location: profile.php?login=successfulpwdreset");
                exit();
            }
        }
    } else if (isset($_POST['newusername'])) {
        
        $username = $_SESSION['username'];
        $newusername = $_POST['newusername'];
        $newpassword = hash('whirlpool', $_POST['password']);

        $query = $conn->prepare("SELECT * FROM users WHERE username='$username'");
        $query->execute();
        $row = $query->fetch();
        
        if ($newpassword != $row['password']) {
            header("Location: profile.php?signup=pwderror");
            exit();
        } else if (!preg_match("/^[a-zA-Z_0-9]*$/", $newusername)) {
            header("Location: profile.php?signup=username");
            exit();
        } else if ($newmusername == 'Admin' || $newmusername == 'admin') {
            header("Location: profile.php?signup=usernamead");
            exit();
        } else {
            $sql = "SELECT COUNT(*) username FROM users WHERE username='$newusername'";
            $res = $conn->query($sql);
            if ($res->fetchColumn() > 0) {
                header("Location: profile.php?signup=usernameexist");
                exit();
            }
            $sql = "UPDATE users SET username = '$newusername' WHERE username = '$username'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            require_once("../login/logout.php");
            header("Location: ../login/login.php?signup=successusernamereset");
            exit();
        }
    } else if (isset($_POST['newemail'])) {
        $username = $_SESSION['username'];
        $newemail = $_POST['newemail'];
        $newpassword = hash('whirlpool', $_POST['password']);

        $query = $conn->prepare("SELECT * FROM users WHERE username='$username'");
        $query->execute();
        $row = $query->fetch();

        if ($newpassword != $row['password']) {
            header("Location: profile.php?signup=pwderror");
            exit();
        } else if (!preg_match("/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/", $newemail)) {
            header("Location: profile.php?signup=invalidemail");
            exit();
        } else {
            $sql = "SELECT COUNT(*) email FROM users WHERE email='$newemail'";
            $res = $conn->query($sql);
            if ($res->fetchColumn() > 0) {
                header("Location: profile.php?signup=emailexist");
                exit();
            }
            $verificationcode = rand(7,9999999);
            $email_messaage = "
            The following link will verify your account and allow you to go online.
           http://localhost:8080/Camagru/user/newemail_verification.php?username=$username&verificationcode=$verificationcode&email=$newemail
            ";
            // Multi.Ordinary.Noob.Develop.Etc MAILINATOR.com
            mail($newemail, "Trender - confirm Email", $email_messaage,"From: Trendernoreply.com");
            $sql = "UPDATE users SET verificationcode = '$verificationcode' WHERE username = '$username'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            header("Location: profile.php?login=Successfulemail");
            exit();
        }
    } else if (isset($_POST['comment notifications'])) {
        $username = $_SESSION['username'];
        $mode = $_POST['comment notifications'];

        $sql = "UPDATE users SET comment_notifications = '$mode' WHERE username = '$username'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        header("Location: profile.php?setting=commentsupdated");
        exit();
    } else {
        header("Location: ../index.php?login=NULL");
        exit();
    }
?>