<?php
function escape($data)
{
    $data = htmlspecialchars($data, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
    $data = trim($data);
    $data = stripslashes($data);
    return ($data);
}

$new_user = array(
    "firstname" => escape($_POST['firstname']),
    "lastname" => escape($_POST['lastname']),
    "email" => escape($_POST['email']),
    "age" => escape($_POST['age']),
    "location" => escape($_POST['location'])
);

if (isset($_POST['submit']) && $statement) {
    echo $new_user['firstname'] . ' successfully added';
}
?>