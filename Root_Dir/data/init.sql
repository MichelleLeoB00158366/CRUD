CREATE DATABASE test;
USE test;
CREATE TABLE users (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL,
    age INT(3),
    location VARCHAR(50),
    date TIMESTAMP
);
UPDATE users
SET firstname = :firstname,
    lastname = :lastname,
    email = :email,
    age = :age,
    location = :location,
    date = :date
WHERE id = :id