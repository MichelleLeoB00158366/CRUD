<?php
require "../common.php";


if (!isset($_GET['id'])) {
    echo "Something went wrong!";
    exit;
}


try {
    require_once '../src/DBconnect.php';
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = :id";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
    exit;
}


if (isset($_POST['submit'])) {
    try {
        $user = [
            "id" => escape($_POST['id']),
            "firstname" => escape($_POST['firstname']),
            "lastname" => escape($_POST['lastname']),
            "email" => escape($_POST['email']),
            "age" => escape($_POST['age']),
            "location" => escape($_POST['location']),
            "date" => escape($_POST['date'])
        ];
        $sql = "UPDATE users
                SET firstname = :firstname,
                    lastname = :lastname,
                    email = :email,
                    age = :age,
                    location = :location
                WHERE id = :id";
        $statement = $connection->prepare($sql);
        $statement->execute($user);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
        exit;
    }
}


require "templates/header.php";
?>

<h2>Edit a user</h2>
<form method="post">
    <?php foreach ($user as $key => $value): ?>
        <label for="<?php echo $key; ?>">
            <?php echo ucfirst($key); ?>
        </label>
        <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : ''); ?>>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>

<?php

if (isset($_POST['submit'])):
    echo escape($_POST['firstname']) . " successfully updated.";
endif;
?>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>