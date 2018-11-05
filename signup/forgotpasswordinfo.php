<?php
    session_start();
    
    if (isset($_POST['submit'])) {
        require_once("../config/setup.php");
        
        //get the login info
        
        $email = $_POST['email'];

        // check for spaces
        if (empty($email)) {
            header("Location: forgotpassword.php?login=spaces");
            exit ();
        } else {
            if (!preg_match("/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/", $email)) {
                header("Location: forgotpassword.php?reset=invalidemail");
                exit();
            }
            $query = $conn->prepare("SELECT * FROM users WHERE email='$email'");
            $query->execute();
            $row = $query->fetch();
            
            if ($row['email'] != '$email') {
                if ($row[$user_state] == 'unregistered') {
                    header("Location: forgotpassword.php?login=unregistered");
                    exit();
                } else {                    
                    $code = rand(7,9999999);
                    $username = $row['username'];
                    $sql = "UPDATE users SET verificationcode = '$code' WHERE username = '$username'";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $email_message = "
                    Hey there $username
                    
                    A password reset was requested for your account,
                    if this was not you ignore this email.
                    
                    To reset your password follow the following link:
                    http://localhost:8080/Camagru/signup/resetverification.php?username=$username&code=$code
                    
                    Thank you for using this site.
                    The Boss.
                    ";

                    mail($email, "Trender - PASSWORD RESET", $email_message, "From: Trender");
                    header("Location: forgotpassword.php?reset=successfulreset");
                    exit();
                }
            } else {
                header("Location: forgotpassword.php?reset=invalidemail");
                exit();
            }
        } 
    } else {
        header("Location: ../index.php?redir");
        exit();
    }
?>