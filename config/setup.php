<?Php
    require_once("database.php");

    try {
        $conn = new PDO($DB_HOST, $DB_USER, $DB_PASSWORD);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE IF NOT EXISTS $DB_NAME CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;";
        $conn->exec($sql);
        //echo "Connected successfully to database<br>";
    }
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage() . "<br>";
    }

    try {
        $sql = "USE $DB_NAME";
        $conn->exec($sql);        

        $sql = "CREATE TABLE IF NOT EXISTS users (
                id INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(30) NOT NULL,
                password VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                firstname VARCHAR(30) NOT NULL,
                lastname VARCHAR(30) NOT NULL,
                gender VARCHAR(30) NOT NULL DEFAULT 'Other',
                profilelocation VARCHAR(100),
                reallocation VARCHAR(100),
                sexuality VARCHAR(15) NOT NULL DEFAULT 'Bisexual',
                Fame INT(7) UNSIGNED,
                Age INT(3) UNSIGNED,
                profilepic INT(1) UNSIGNED,
                user_state VARCHAR(30) NOT NULL DEFAULT 'unregistered',
                comment_notifications VARCHAR(4) NOT NULL DEFAULT 'ON',
                verificationcode INT(7) UNSIGNED NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin";
        
        $conn->exec($sql);
        //echo "User table created successfully<br>";

        $sql = "CREATE TABLE IF NOT EXISTS tags (
            userid INT(7) UNSIGNED NOT NULL PRIMARY KEY,
            tag1 VARCHAR(20) NOT NULL DEFAULT 'empty',
            tag2 VARCHAR(20) NOT NULL DEFAULT 'empty',
            tag3 VARCHAR(20) NOT NULL DEFAULT 'empty',
            tag4 VARCHAR(20) NOT NULL DEFAULT 'empty',
            tag5 VARCHAR(20) NOT NULL DEFAULT 'empty'
        ) ENGINE=InnoDB DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin";
    
        $conn->exec($sql);
        //echo "tag table created successfully<br>";

        $sql = "CREATE TABLE IF NOT EXISTS messages (
            messageid INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            senderid INT(7) UNSIGNED NOT NULL,
            receiverid INT(7) UNSIGNED NOT NULL,
            textmessage VARCHAR(255) NOT NULL 
        ) ENGINE=InnoDB DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin";
    
        $conn->exec($sql);
        //echo "messages table created successfully<br>";

        $sql = "CREATE TABLE IF NOT EXISTS chatmatch (
            id1 INT(7) UNSIGNED NOT NULL,
            id2 INT(7) UNSIGNED NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin";
    
        $conn->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS profilelikes (
            userid INT(7) UNSIGNED NOT NULL,
            likerid INT(7) UNSIGNED NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin";
    
        $conn->exec($sql);
        //echo "profilelikes table created successfully<br>";
    }
    catch(PDOException $e) {
        echo "Table creation failed: " . $e->getMessage() . "<br>";
    }
?>