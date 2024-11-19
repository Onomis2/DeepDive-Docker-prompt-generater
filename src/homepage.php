<?php

require("connection.php");

$Database = $dbh->prepare("SELECT * FROM subjects ORDER BY id");
$Database->execute();
$subjects = $Database->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>home</title>
</head>
<body>
    <nav class="right-button-login">
        <a href="login.php"><button class="login-button">Login</button></a>
    </nav>
    <div class="title-center-home">
        <h1>Choose a subject</h1>
    </div>
    <div class="center-boxes">
        <?php foreach ($subjects as $subject) { ?>
            <a href="choice.php"><p class="boxes"><?= $subject['subject'];?></p></a>
        <?php } ?>
    </div>
</body>
</html>