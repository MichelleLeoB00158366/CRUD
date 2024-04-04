<?php

$host = "localhost";
$db_name = "your_database_name";
$username = "your_username";
$password = "your_password";
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);

try {
    $connection = new PDO("mysql:host=$host;dbname=$db_name", $username, $password, $options);
    echo "Database connection successful!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>