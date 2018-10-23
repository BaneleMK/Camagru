<?php
    
    if (isset($_POST['submit'])) {
        require_once("config/setup.php");
        $username = $_POST['username'];
        $password = hash('whirlpool', $_POST['password']);
        $email = $_POST['email'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];

        if (empty($username) || empty($_POST['password']) || empty($email) || empty($firstname) || empty($lastname)){
            echo "theres a space missing.<br>";
            exit ();
        }
        else {
            if (!preg_match("/^[a-zA-Z]*$/", $firstname) || !preg_match("/^[a-zA-Z]*$/", $firstname)) {
                echo "both first and last names must have only letters<br>";
                exit();
            } else if (!preg_match("/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/", $email)) {
                echo "requesting a proper email. if you dont have it...then make it<br>";
                exit();
            } else if (!preg_match("/^[a-zA-Z_0-9]*$/", $username)) {
                echo "Usersnames characters are a-z A-Z 0-9 and underscore '_' <br>";
                exit();
            } else {
                try {
                    $slq = "SELECT * FROM users WHERE email='$email'";
                    $emailhits = $conn->query($sql);
                    if ($emailhits->fetchcolumn() > 0) {
                        echo "email already exists<br>";
                        exit();
                    }
                    else {
                        $sql = "INSERT INTO users (username, password, email, firstname, lastname) VALUES ('$username', '$password', '$email', '$firstname', '$lastname')";
                        if ($conn->query($sql) === FALSE) {
                            echo "New record was unsuccessful<br>";
                        }
                        else {
                            echo "New record created successfully<br>";
                        }
                    }
                }
                catch(PDOException $e) {
                    echo "creation failed: " . $e->getMessage() . "<br>";
                }
                echo "$username<br>$password<br>$email<br>$firstname<br><br>";
                header("Location: signup.php");
            }
        }
    } else {
        echo "no permission to launch this <br>";
    }
?>