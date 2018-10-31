
<?php
    
    session_start();
    
    require_once("config/setup.php");

    if (isset($_GET['username']) && isset($_GET['verificationcode'])) {
        $username = $_GET['username'];
        $code = $_GET['verificationcode'];
        $query = $conn->prepare("SELECT * FROM users WHERE username='$username'");
        $query->execute();

        $row = $query->fetch();
        /*echo $username;
        echo '<br>';
        echo $code;
        echo $row['username'];
        echo $row['verificationcode'];*/
        echo "made it here<br>";
        if ($row['username'] == $username && $row['verificationcode'] == $code) {
            echo "made it here 1<br>";
            if ($row['user_status'] == 'registered') {
                echo "made it here 1.5<br>";
                header("Location: login.php?login=registered");
                exit();
            } else {
                echo "made it here 2<br>";
                $sql = "UPDATE users SET user_state = 'registered' WHERE username = '$username'";
                echo "made it here 3<br>";
                $stmt = $conn->prepare($sql);
                echo "made it here 4<br>";
                $stmt->execute();
                echo "made it here 5<br>";
                header("Location: login.php?login=Successful");
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