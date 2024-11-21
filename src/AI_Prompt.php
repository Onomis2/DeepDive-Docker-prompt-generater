<?php

require("connection.php");

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Prompt Generator</title>
</head>
<body>
    <nav class="right-button-login">
        <?php if (empty($_SESSION["loggedInUser"])) { ?>
            <a href="login-logout/login.php"><button class="login-button">Login</button></a>
            <a href="homepage.php"><button class="back">Back</button></a>
        <?php } else { ?>
            <a href="login-logout/logout.php"><button class="login-button">Logout</button></a>
            <a href="homepage.php"><button class="back">Back</button></a>
        <?php } ?>
    </nav>
    <div class="center-boxes">
        <div class="boxes">
            <label for="prompt">Enter Prompt:</label>
            <textarea name="" id="prompt">  </textarea>
            <button class="send">send</button>
        </div>
    </div>
    <script>
        document.querySelector('.send')
            .addEventListener('click', () => {
                const data = new URLSearchParams();
                data.append('prompt', document.getElementById('prompt').value);
                fetch('ai_api.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: data
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data)
                    document.getElementById('prompt').value = data.response
            })
            })
    </script>
</body>
</html>