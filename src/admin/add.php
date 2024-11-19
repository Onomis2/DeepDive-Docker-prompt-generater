<?php

require("../connection.php");

session_start();

if (empty($_SESSION["loggedInUser"])) {
    header("Location: ../login-logout/login.php");
    die;
}

$Database = $dbh->prepare("SELECT * FROM subjects ORDER BY id");
$Database->execute();
$subjects = $Database->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>add prompts</title>
</head>
<body>
    <nav class="right-button-login">
        <a href="../login-logout/logout.php"><button class="login-button">Logout</button></a>
        <a href="../homepage.php"><button class="back">Back</button></a>
    </nav>
    <div class="title-center-home">
        <h1>Add a prompt</h1>
    </div>
    <form method="post">
        <?php foreach ($subjects as $subject) { ?>
            <input type="radio" name="subject" value="<?= $subject['id']; ?>"><?= $subject['subject']; ?>
        <?php } ?>
    </form>
</body>
</html>