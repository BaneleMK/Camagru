<?php
    require_once("config/setup.php");
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    if (empty($username) || empty($_POST['password']) || empty($email) || empty($firstname) || empty($lastname)){
        echo "theres a space missing.<br>";
        die();
    }
    else {
        try {
            if ("SELECT COUNT(*) email FROM users WHERE email = $email Limit 1" > 0)
                echo "found!<br>";
            }
            else {
                echo "Not found!<br>";
            }
            $sql = "INSERT INTO users (username, password, email, firstname, lastname) VALUES ('$username', '$password', '$email', '$firstname', '$lastname')";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully<br>";
            }
            else {
                echo "New record was unsuccessful<br>";
            }
        }
        catch(PDOException $e) {
            echo "creation failed: " . $e->getMessage() . "<br>";
        }
        echo "$username<br>$password<br>$email<br>$firstname<br><br>";
    }
?>