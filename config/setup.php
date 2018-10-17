<?Php
    require_once("database.php");

    try {
        $conn = new PDO($DB_HOST, $DB_USER, $DB_PASSWORD);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->exec("DROP DATABASE IF EXISTS " . $DB_NAME);
        $sql = "CREATE DATABASE IF NOT EXISTS $DB_NAME";
        $conn->exec($sql);
        echo "Connected successfully to database<br>";
    }
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage() . "<br>";
    }

    try {
        $sql = "USE $DB_NAME";
        $conn->exec($sql);        

        $sql = "CREATE TABLE users (
                id INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(30) NOT NULL,
                email VARCHAR(255) NOT NULL,
                firstname VARCHAR(30) NOT NULL,
                lastname VARCHAR(30) NOT NULL
            )";
        
        $conn->exec($sql);
        echo "User table created successfully<br>";

        $sql = "CREATE TABLE post (
            id INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(30) NOT NULL,
            picture TEXT NOT NULL,
            likes INT(10) UNSIGNED,
            dislikes INT(10) UNSIGNED
        )";
    
        $conn->exec($sql);
        echo "post table created successfully<br>";
    }
    catch(PDOException $e) {
        echo "Table creation failed: " . $e->getMessage() . "<br>";
    }
?>