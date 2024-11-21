<?php

require("connection.php");

session_start();

$Database = $dbh->prepare("SELECT choices.* FROM choices INNER JOIN tags ON choices.id = tags.choice_id WHERE tags.subject_id = :id");
$subjectId = filter_var($_GET['subject'], FILTER_SANITIZE_NUMBER_INT);
$Database->bindParam(':id',$subjectId);
$Database->execute();
$choices = $Database->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>choice</title>
</head>
<body>
    <nav class="right-button-login">
        <?php if (empty($_SESSION["loggedInUser"])) { ?>
            <a href="login-logout/login.php"><button class="login-button">Login</button></a>
            <a href="homepage.php"><button class="back">Back</button></a>
        <?php } else { ?>
            <a href="login-logout/logout.php"><button class="login-button">Logout</button></a>
            <a href="admin/add.php?subject=<?= $_GET['subject']?>"><button class="add">Add</button></a>
            <a href="admin/delete.php?subject=<?= $_GET['subject']?>"><button class="delete">Delete</button></a>
            <a href="homepage.php"><button class="back">Back</button></a>
        <?php } ?>
    </nav>
    <div class="title-center-home">
        <h1>Choose a format</h1>
    </div>
    <div class="center-boxes-two">
        <div class="row-boxes">
            <?php

            $counter = 0;
            foreach ($choices as $choice) { 
                if ($counter % 3 == 0) { ?>
                    <div class="row">
                <?php } ?>
                <a href="prompt.php?subject=<?=$_GET['subject'];?>&choice=<?=$choice['id'];?>"><p class="boxes-two"><?= $choice['choice'];?></p></a>
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
