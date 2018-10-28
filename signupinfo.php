<?php
    
    if (isset($_POST['submit'])) {
        require_once("config/setup.php");
        $username = $_POST['username'];
        $password = hash('whirlpool', $_POST['password']);
        $email = $_POST['email'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];

        if (empty($username) || empty($_POST['password']) || empty($email) || empty($firstname) || empty($lastname)){
            header("Location: signup.php?signup=email");
            //echo "theres a space missing.<br>";
            //exit ();
        }
        else {
            if (!preg_match("/^[a-zA-Z]*$/", $firstname) || !preg_match("/^[a-zA-Z]*$/", $lastname)) {
                header("Location: signup.php?signup=names");
                //echo "both first and last names must have only letters<br>";
                //exit();
            } else if (!preg_match("/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/", $email)) {
                header("Location: signup.php?signup=email");
                //echo "requesting a proper email. if you dont have it...then make it<br>";
                //exit();
            } else if (!preg_match("/^[a-zA-Z_0-9]*$/", $username)) {
                header("Location: signup.php?signup=username");
                //echo "Usersnames characters are a-z A-Z 0-9 and underscore '_' <br>";
                exit();
            } else if ($username == 'Admin' || $username == 'admin') {
                header("Location: signup.php?signup=usernamead");
                //echo "Username cant be Admin or admin <br>";
                //exit();
            } else {
                $sql = "SELECT COUNT(*) email FROM users WHERE email='$email'";
                $res = $conn->query($sql);
                if ($res->fetchColumn() > 0) {
                    echo "email already exists, try another one<br>";
                        exit();
                    }
                try {
                        $sql = "INSERT INTO users (username, password, email, firstname, lastname) VALUES ('$username', '$password', '$email', '$firstname', '$lastname')";
                        if ($conn->query($sql) === FALSE) {
                            echo "New record was unsuccessful<br>";
                        }
                        else {
                            echo "New record created successfully<br>";
                        }
                    }
                catch(PDOException $e) {
                    echo "creation failed: " . $e->getMessage() . "<br>";
                    header("Location: signup.php?signup=faulty");
                    //exit();
                }
            }
            //echo "$username<br>$password<br>$email<br>$firstname<br><br>";
            header("Location: signup.php?signup=Successful");
            }
    } else {
        echo "no permission to launch this <br>";
    }
?>