<?php

require("../connection.php");

session_start();

if (empty($_SESSION["loggedInUser"])) {
    header("Location: ../login-logout/login.php");
    die;
}

if (!empty($_GET['subject'])) {
    $Database = $dbh->prepare("SELECT choices.* FROM choices INNER JOIN tags ON choices.id = tags.choice_id WHERE tags.subject_id = :id");
    $subjectId = filter_var($_GET['subject'], FILTER_SANITIZE_NUMBER_INT);
    $Database->bindParam(':id',$subjectId);
    $Database->execute();
    $deletechoice = $Database->fetchAll(PDO::FETCH_ASSOC);
} else {
    $Database = $dbh->prepare("SELECT * FROM subjects");
    $Database->execute();
    $deletesubjects = $Database->fetchAll(PDO::FETCH_ASSOC);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_GET['subject'])) {
        $deletechoices = filter_var($_POST['deletechoice'], FILTER_SANITIZE_NUMBER_INT);
        $Database = $dbh->prepare("DELETE FROM tags WHERE choice_id = :id");
        $Database->bindParam(':id', $deletechoices);
        $Database->execute();

        $Database = $dbh->prepare("DELETE FROM choices WHERE id = :id");
        $Database->bindParam(':id', $deletechoices);
        $Database->execute();
        header("Location: ../homepage.php");
        die;
    } else {
        $deletesubject = filter_var($_POST['deletesubject'], FILTER_SANITIZE_NUMBER_INT);
        $deletechoiceforsubject = $dbh->prepare("SELECT choice_id FROM tags WHERE subject_id = :id");
        $deletechoiceforsubject->bindParam(':id', $deletesubject);
        $deletechoiceforsubject->execute();
        $deletechoices = $deletechoiceforsubject->fetchAll(PDO::FETCH_ASSOC);

        $Database = $dbh->prepare("DELETE FROM tags WHERE subject_id = :id");
        $Database->bindParam(':id', $deletesubject);
        $Database->execute();

        foreach ($deletechoices as $deletechoice) {
            $Database = $dbh->prepare("DELETE FROM choices WHERE id = :id");
            $Database->bindParam(':id', $deletechoice['choice_id']);
            $Database->execute();
        }

        $Database = $dbh->prepare("DELETE FROM subjects WHERE id = :id");
        $Database->bindParam(':id', $deletesubject);
        $Database->execute();
        header("Location: ../homepage.php");
        die;
    }
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
                <?php if (!empty($_GET['subject'])) { ?>
                    <div class="space">
                        <label for="deletechoice">Choose a prompt to delete:</label>
                    </div>
                    <?php foreach ($deletechoice as $selectdeletechoice) { ?>
                        <div class="space">
                            <input type="radio" name="deletechoice" value="<?= $selectdeletechoice['id'];?>"><?= $selectdeletechoice['choice'];?>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="space">
                        <label for="deletesubject">Choose a subject to delete:</label>
                    </div>
                    <?php foreach ($deletesubjects as $selectdeletesubject) { ?>
                        <div class="space">
                            <input type="radio" name="deletesubject" value="<?= $selectdeletesubject['id'];?>"><?= $selectdeletesubject['subject'];?>
                        </div>
                    <?php } ?>
                <?php } ?>
                <input type="submit" value="Delete">
            </form>
        </div>
    </div>
</body>
</html>