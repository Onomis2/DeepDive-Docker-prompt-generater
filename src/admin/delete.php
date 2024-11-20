<?php

require("../connection.php");

session_start();

if (empty($_SESSION["loggedInUser"])) {
    header("Location: ../login-logout/login.php");
    die;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>delete</title>
</head>
<body>
    <nav class="right-button-login">
        <a href="../login-logout/logout.php"><button class="login-button">Logout</button></a>
        <a href="../homepage.php"><button class="back">Back</button></a>
    </nav>
    <div class="title-center-home">
        <h1>Delete a prompt</h1>
    </div>
    <div class="center-boxes">
        <div class="boxes">
            <form method="post">
                <?php if ($subject) { ?>
                <?php } else { ?>
                <?php } ?>
            </form>
        </div>
    </div>
</body>
</html>