<?php
    
    session_start();
    
    if (isset($_POST['submit'])) {
        require_once("../config/setup.php");
        
        //get the login info
        
        $username = htmlspecialchars("$_POST['username']");
        $password = hash('whirlpool', $_POST['password']));
        
        // check for spaces
        if (empty($username) || empty(htmlspecialchars("$_POST['password']"))) {
            header("Location: login.php?login=spaces");
            exit ();
        }
        else {
            $query = $conn->prepare("SELECT * FROM users WHERE username='$username'");
            $query->execute();

            $uservalid = 0;
            for($i=0; $row = $query->fetch(); $i++) {
                if ($row['username'] == $username) {
                    if ($row['password'] == $password) {
                        $uservalid = 1;
                        break ;
                    }
                }
            }
            if ($uservalid == 0) {
                header("Location: login.php?login=userunknown");
                exit();
            } else {
                if ($row['user_state'] == 'unregistered') {
                    header("Location: login.php?login=unregistered");
                    exit();
                } else {
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['fistname'] = $row['fistname'];
                    $_SESSION['lastname'] = $row['lastname'];
                    $_SESSION['email'] = $row['email'];
                    header("Location: ../index.php?login=Successful");
                    exit();
                }
            }
        }
    } else {
        header("Location: ../index.php");
        exit();
    }
?>