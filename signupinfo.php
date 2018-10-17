<?php
    require_once("config/setup.php");
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    if (empty($username) || empty($password) || empty($email) || empty($firstname) || empty($lastname)){
        echo "theres a space missing.<br>";
        die();
    }
    else {
        echo "phase2<br>";
        $sql = "INSERT INTO users (username, password, email, firstname, lastname)
        VALUES ($username, $password, $email, $firstname, $lastname)";
        echo "phase3<br>";
        if ($conn->query($sql) === TRUE) {
            echo "!New record created successfully<br>";
        }
        echo "phase4<br>";
    }
?>