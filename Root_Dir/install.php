<?php

// dtabase 
$db_type = "mysql";
$db_host = "localhost";
$db_name = "your_database_name";
$db_username = "your_username";
$db_password = "your_password";

// PDO connection
try {
    $connection = new PDO(
        "$db_type:host=$db_host;dbname=$db_name",
        $db_username,
        $db_password,
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        )
    );
    echo "Database connection successful!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>