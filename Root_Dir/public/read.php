<?php
require_once "../common.php";
require_once '../src/DBconnect.php';

if (isset($_GET['id'])) {
    try {
        $id = $_GET['id'];
        $sql = "SELECT * FROM users WHERE id = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
} else {
    echo "Something went wrong!";
    exit;
}

if (isset($_POST['submit'])) {
    try {
        $sql = "SELECT * FROM users WHERE location = :location";
        $location = $_POST['location'];
        $statement = $connection->prepare($sql);
        $statement->bindParam(':location', $location, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll();
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

require "templates/header.php";

if (isset($_POST['submit'])) {
    if ($result && $statement->rowCount() > 0) {
        ?>
        <h2>Results</h2>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email Address</th>
                    <th>Age</th>
                    <th>Location</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($result as $row) {
                    ?>
                    <tr>
                        <td>
                            <?php echo escape($row["id"]); ?>
                        </td>
                        <td>
                            <?php echo escape($row["firstname"]); ?>
                        </td>
                        <td>
                            <?php echo escape($row["lastname"]); ?>
                        </td>
                        <td>
                            <?php echo escape($row["email"]); ?>
                        </td>
                        <td>
                            <?php echo escape($row["age"]); ?>
                        </td>
                        <td>
                            <?php echo escape($row["location"]); ?>
                        </td>
                        <td>
                            <?php echo escape($row["date"]); ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    } else {
        ?>
        <p>No results found for
            <?php echo escape($_POST['location']); ?>.
        </p>
        <?php
    }
}
?>
<h2>Find user based on location</h2>
<form method="post">
    <label for="location">Location</label>
    <input type="text" id="location" name="location">
    <input type="submit" name="submit" value="View Results">
</form>
<a href="index.php">Back to home</a>
<?php require "templates/footer.php"; ?>