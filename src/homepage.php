<?php

$subjects = array('code', 'bakken', 'storytelling', 'b', 'p', 'j', 'h', 'y', 't', '4'); // test data
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
    <div class="title-center-home">
        <h1>Choose a subject</h1>
        <nav class="right-button-login">
            <a href="login.php"><button class="login-button">Login</button></a>
        </nav>
    </div>
    <div class="center-boxes">
        <?php foreach ($subjects as $subject) { ?>
            <a href="choise.php"><p class="boxes"><?= $subject;?></p></a>
        <?php } ?>
    </div>
</body>
</html>