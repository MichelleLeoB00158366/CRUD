<?php
require_once '../common.php';
require_once '../src/DBconnect.php';

if (isset($_POST['submit'])) {
    try {
        $new_user = array(
            "firstname" => escape($_POST['firstname']),
            "lastname" => escape($_POST['lastname']),
            "email" => escape($_POST['email']),
            "age" => escape($_POST['age']),
            "location" => escape($_POST['location'])
        );

        $existing_user = $connection->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $existing_user->execute(array('email' => $new_user['email']));
        $count = $existing_user->fetchColumn();

        if ($count == 0) {
            $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "users",
                implode(", ", array_keys($new_user)),
                ":" . implode(", :", array_keys($new_user))
            );
            $statement = $connection->prepare($sql);
            $statement->execute($new_user);
            echo $new_user['firstname'] . ' successfully added';
        } else {
            echo 'User with this email already exists';
        }
    } catch (PDOException $error) {
        echo "Error: " . $error->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
</head>

<body>
    <h2>Add a user</h2>
    <form method="post">
        <label for="firstname">First Name</label>
        <input type="text" name="firstname" id="firstname" required>
        <label for="lastname">Last Name</label>
        <input type="text" name="lastname" id="lastname" required>
        <label for="email">Email Address</label>
        <input type="email" name="email" id="email" required>
        <label for="age">Age</label>
        <input type="text" name="age" id="age">
        <label for="location">Location</label>
        <input type="text" name="location" id="location">
        <input type="submit" name="submit" value="Submit">
    </form>
    <a href="index.php">Back to home</a>
</body>

</html>