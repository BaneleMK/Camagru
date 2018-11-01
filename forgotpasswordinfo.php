<?php
    session_start();
    
    if (isset($_POST['submit'])) {
        require_once("config/setup.php");
        
        //get the login info
        
        $email = $_POST['email'];

        // check for spaces
        if (empty($email)) {
            header("Location: forgotpassword.php?login=spaces");
            exit ();
        } else {
            if (!preg_match("/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/", $email)) {
                header("Location: forgotpassword.php?reset=invalidemail");
                //echo "requesting a proper email. if you dont have it...then make it<br>";
                exit();
            }
            echo "1<br>";
            $query = $conn->prepare("SELECT * FROM users WHERE email='$email'");
            $query->execute();
            $row = $query->fetch();
            
            if ($row['email'] != '$email') {
                echo "emails are equal";
                if ($row[$user_state] == 'unregistered') {
                    header("Location: forgotpassword.php?login=unregistered");
                    exit();
                } else {                    
                    echo "2<br>";
                    $code = rand(7,9999999);
                    
                    echo "3<br>";
                    $username = $row['username'];
                    $sql = "UPDATE users SET verificationcode = '$code' WHERE username = '$username'";
                    echo "4<br>";
                    $stmt = $conn->prepare($sql);
                    echo "4.5<br>";
                    $stmt->execute();
                    
                    echo "5<br>";
                    $email_message = "
                    Hey there $username
                    
                    A password reset was requested for your account,
                    if this was not you ignore this email.
                    
                    To reset your password follow the following link:
                    http://localhost:8080/Camagru/resetpassword.php?username=$username&code=$code
                    
                    Thank you for using this site.
                    The Boss.
                    ";

                    echo "6<br>";
                    mail($email, "Trender - PASSWORD RESET", $email_message, "From: Trender");

                    //echo "user exists and is available <br>";
                    header("Location: forgotpassword.php?reset=successfulreset");
                    exit();
                }
            } else {
                echo "1.5<br>" . "dbemail = " . $row['email'];
                echo "<br>ntemail = " . $email;
                header("Location: forgotpassword.php?reset=invalidemail");
                exit();
            }
        } 
    } else {
        header("Location: index.php");
        exit();
    }
?>