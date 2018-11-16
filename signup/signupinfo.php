<?php
    
    if (isset($_POST['submit'])) {
        require_once("../config/setup.php");
        $username = $_POST['username'];
        $password = hash('whirlpool', $_POST['password']);
        $email = strtolower($_POST['email']);
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $verificationcode = rand(7,9999999);

        if (empty($username) || empty($_POST['password']) || empty($email) || empty($firstname) || empty($lastname)){
            header("Location: signup.php?signup=empty");
            //echo "theres a space missing.<br>";
            exit ();
        } else if ($_POST['password'] != $_POST['password_vr']){
            header("Location: signup.php?signup=pwderror");
        }
        else {
            if (!preg_match("/^[a-zA-Z]*$/", $firstname) || !preg_match("/^[a-zA-Z]*$/", $lastname)) {
                header("Location: signup.php?signup=names");
                //echo "both first and last names must have only letters<br>";
                exit();
            } else if (!preg_match("/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/", $email)) {
                header("Location: signup.php?signup=invalidemail");
                //echo "requesting a proper email. if you dont have it...then make it<br>";
                exit();
            } else if (!preg_match("/^[a-zA-Z_0-9]*$/", $username)) {
                header("Location: signup.php?signup=username");
                //echo "Usersnames characters are a-z A-Z 0-9 and underscore '_' <br>";
                exit();
            } else if ($username == 'Admin' || $username == 'admin') {
                header("Location: signup.php?signup=usernamead");
                //echo "Username cant be Admin or admin <br>";
                exit();
            } else if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/", $_POST['password'])) {
                header("Location: signup.php?signup=pwdreq");
                //only strong passwords allowed in this db. thanks to psutton3756;
                exit();
            } else {
                $sql = "SELECT COUNT(*) email FROM users WHERE email='$email'";
                $res = $conn->query($sql);
                if ($res->fetchColumn() > 0) {
                    header("Location: signup.php?signup=emailexist");
                    exit();
                }
                $sql = "SELECT COUNT(*) username FROM users WHERE username='$username'";
                $res = $conn->query($sql);
                if ($res->fetchColumn() > 0) {
                    header("Location: signup.php?signup=usernameexist");
                    exit();
                }
                try {
                    $sql = "INSERT INTO users (username, password, email, firstname, lastname, verificationcode) VALUES ('$username', '$password', '$email', '$firstname', '$lastname', '$verificationcode')";
                    if ($conn->query($sql) === FALSE) {
                        echo "New record was unsuccessful<br>";
                    }
                    else {
                        echo "New record created successfully<br>";
                    }
                } catch(PDOException $e) {
                    header("Location: signup.php?signup=faulty");
                    exit();
                }
                $email_messaage = "
                The following link will verify your account and allow you to go online.
               http://localhost:8080/Camagru/signup/email_verification.php?username=$username&verificationcode=$verificationcode
                ";
                // Multi.Ordinary.Noob.Develop.Etc MAILINATOR.com
                mail($email, "Trender - confirm Email", $email_messaage,"From: Trendernoreply.com");
            }
            //http://localhost:8080/Camagru/email_verification.php?username=banex&verificationcode=6326569
            //echo "$username<br>$password<br>$email<br>$firstname<br><br>";
            header("Location: signup.php?signup=Successfulcreation");
        }
    } else {
        header("Location: ../index.php?");
        exit();
    }