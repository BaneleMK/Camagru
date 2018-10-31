<?php
    
    session_start();
    
    if (isset($_POST['submit'])) {
        require_once("config/setup.php");
        
        //get the login info
        
        $email = $_POST['email'];
        // check for spaces
        if (empty($method)){
            header("Location: forgotpassword.php?login=spaces");
            exit ();
        } else {
            $query = $conn->prepare("SELECT * FROM users WHERE email='$email'");
            $query->execute();

            $row = $query->fetch();
                if ($row['username'] == $username) {
                    if ($row['password'] == $password) {
                        $uservalid = 1;
                        break ;
                    }
                }
            }
            
            if ($uservalid == 0) {
                header("Location: login.php?login=Error");
                exit();
            } else {
                if ($row[$user_state] == 'unregistered') {
                    header("Location: login.php?login=unregistered");
                    exit();
                } else {
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['fistname'] = $row['fistname'];
                    $_SESSION['lastname'] = $row['lastname'];
                    $_SESSION['email'] = $row['email'];
                    //echo "user exists and is available <br>";
                    header("Location: index.php?login=Successful");
                    exit();
                }
            }

            //if ($conn->query($sql)['password'] == "$password")
            //    echo "password correct<br>";
            //else
            //    echo "password incorrect<br>";
        }
        //header("Location: log_in_info.php?login=Successful");
        //echo "$username<br>$password<br>$email<br>$firstname<br><br>";
    } else {
        header("Location: index.php");
        exit();
    }
?>