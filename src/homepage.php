<?php

require("connection.php");

session_start();

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
        <?php if (empty($_SESSION["loggedInUser"])) { ?>
            <a href="login-logout/login.php"><button class="login-button">Login</button></a>
        <?php } else { ?>
            <a href="login-logout/logout.php"><button class="login-button">Logout</button></a>
            <a href="admin/add.php"><button class="add">Add</button></a>
            <a href="admin/delete.php"><button class="delete">Delete</button></a>
        <?php } ?>
    </nav>
    <div class="title-center-home">
        <h1>Choose a subject</h1>
    </div>
    <div class="down-left-box">
        <a href="AI_Prompt.php"><p class="box-left">Generate a prompt with AI</p></a>
    </div>
    <div class="center-boxes-two">
        <div class="row-boxes">
            <?php

            $counter = 0;
            foreach ($subjects as $subject) { 
                if ($counter % 3 == 0) { ?>
                    <div class="row">
                <?php } ?>
                <a href="choice.php?subject=<?=$subject['id'];?>"><p class="boxes-two"><?= $subject['subject'];?></p></a>
                <?php

                $counter++;
                if ($counter % 3 == 0) { ?>
                    </div>
                <?php } 
            } 
            if ($counter % 3 != 0) { ?>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>