<?php

$subjects = array('code', 'bakken', 'storytelling'); // test data
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
        <h1>Home</h1>
    </div>
    <div class="center-boxes">
        <?php foreach ($subjects as $subject) { ?>
            <p class="boxes"><?= $subject;?></p>
        <?php } ?>
    </div>
</body>
</html>