
<?php
    
    session_start();
    
    require_once("../config/setup.php");

    if (isset($_GET['username']) && isset($_GET['verificationcode'])) {
        $username = $_GET['username'];
        $code = $_GET['verificationcode'];
        $query = $conn->prepare("SELECT * FROM users WHERE username='$username'");
        $query->execute();
        $row = $query->fetch();
        if ($row['username'] == $username && $row['verificationcode'] == $code) {
            if ($row['user_status'] == 'registered') {
                header("Location: ../login/login.php?login=registered");
                exit();
            } else {
                $sql = "UPDATE users SET user_state = 'registered' WHERE username = '$username'";
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