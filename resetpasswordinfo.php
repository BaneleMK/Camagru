
<?php
    
    session_start();
    
    require_once("config/setup.php");

    if (isset($_GET['username']) && isset($_GET['verificationcode'])) {
        $username = $_GET['username'];
        $code = $_GET['verificationcode'];
        $query = $conn->prepare("SELECT * FROM users WHERE username='$username'");
        $query->execute();

        $row = $query->fetch();
        if ($_POST['password'] != $_POST['password_vr']){
            header("Location: resetpassword.php?resetpassword=pwderror");
        } else if ($row['username'] == $username && $row['verificationcode'] == $code) {
            $newpassword = hash('whirlpool', $_POST['password']);
            if ($row['password'] == $newpassword ) {
                header("Location: login.php?login=samepassword");
                exit();
            } else {
                $sql = "UPDATE users SET password = '$newpassword', verificationcode = 0 WHERE username = '$username'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                header("Location: login.php?login=successfulpwdreset");
                exit();
            }
        } else {
            header("Location: login.php?login=unexpectederror");
            exit();
        }
    } else {
        header("Location: index.php");
        exit();
    }

    /*else {
        echo "made it here 2<br>";
    //              $sql = "INSERT INTO users (user_state) VALUES ('registered')";
        $sql = "UPDATE users SET user_state = 'registered' WHERE username = '$username'";
        $stmt= $dpo->prepare($sql);
        
        echo "made it here after 3suspect<br>";
        if ($stmt->execute($sql) === FALSE) {
            echo "made it here 4<br>";
            header("Location: login.php?login=unexpectederrorreg");
            exit();
        } else {
            echo "made it here 5<br>";
            echo "verified<br>";
            header("Location: login.php?login=Successful");
            exit();
        }
    }*/
?>