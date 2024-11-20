<?php

require("../connection.php");

session_start();

if (!empty($_SESSION["loggedInUser"])) {
    $_SESSION["loggedInUser"] = null;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $Database = $dbh->prepare("SELECT * FROM users WHERE username = :username");
    $Database->bindParam(":username", $username);
    $Database->execute();
    $user = $Database->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["loggedInUser"] = $user;
        header("Location: ../homepage.php");
        die;
    } else {
        echo "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>login</title>
</head>
<body>
    <div class="title-center-home">
        <nav class="right-button-login">
            <a href="../homepage.php"><button class="back">back</button></a>
        </nav>
        <h1>Login</h1>
    </div>
    <div class="center-boxes">
        <div class="boxes">
            <form method="post">
                <div class="space">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username">
                </div>
                <div class="space">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password">
                </div>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>
</html>