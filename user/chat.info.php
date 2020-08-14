<?php

    // add a form with 
    // name=receiver = for the person sending
    // name=textmessage = the message its self

    session_start();
    if (isset($_POST['message']) && isset($_SESSION['id'])){
        require_once('../config/setup.php');
        include_once('../functions/sanitize.php'); 
        try {
            $id1 = $_SESSION['id'];
            $id2 = $_POST['receiver'];

            $sql = "SELECT COUNT(*) FROM chatid WHERE id1 = $id1 AND id2 = $id2";
            $res = $conn->query($sql);

            $sql = "SELECT COUNT(*) FROM chatid WHERE id1 = $id1 AND id2 = $id2";
            $res2 = $conn->query($sql);
            
            if ($res->fetchColumn() > 0 || $res2->fetchColumn() > 0) {
                $message = $_POST['message'];
                $senderid = $_SESSION['id'];
                $receiverid = $_POST['receiver'];

                $sql = "INSERT INTO messages (senderid, receiver, textmessage)
                VALUES(:senderid, :receiver, :textmessage)";

                $stmt->bindParam(':senderid', $senderid);
                $stmt->bindParam(':receiverid', $receiverid);
                $stmt->bindParam(':textmessage', $textmessage);
                $stmt->execute();
            } else {
                header("Location: profile.php");
                exit();
            }
        } catch(PDOException $e) {
            echo "Table creation failed: " . $e->getMessage() . "<br>";
        }
    }