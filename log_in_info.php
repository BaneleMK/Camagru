<?php
    
    if (isset($_POST['submit'])) {
        require_once("config/setup.php");
        
        //get the login info
        
        $username = $_POST['username'];
        $password = hash('whirlpool', $_POST['password']);
        
        // check for spaces
        if (empty($username) || empty($_POST['password'])){
            header("Location: login.php?login=spaces");
            //echo "theres a space missing.<br>";
            //exit ();
        }
        else {
            /*$sql = "SELECT * FROM users WHERE username='$username'";
            $res = $conn->query($sql);
            if ($res->rowcount() == 1) {
                echo "user exists yey<br>";
                if ($conn->query($sql)['password'] == "$password")
                    echo "password correct<br>";
                else
                    echo "password correct<br>";
            } else {
                echo "user does not exist<br>";
            }*/
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
            
            if ($uservalid == 0)
                echo "user does not exists, check your username or password<br>";
            else
                echo "user exists and is available <br>";

            //if ($conn->query($sql)['password'] == "$password")
            //    echo "password correct<br>";
            //else
            //    echo "password incorrect<br>";
        }
        //header("Location: log_in_info.php?login=Successful");
        //echo "$username<br>$password<br>$email<br>$firstname<br><br>";
    } else {
        echo "no permission to launch this <br>";
    }
?>