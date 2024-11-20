<?php

require("../connection.php");

session_start();

if (empty($_SESSION["loggedInUser"])) {
    header("Location: ../login-logout/login.php");
    die;
}

$Database = $dbh->prepare("SELECT * FROM subjects WHERE id = :id");
$Database->bindParam(':id', $_GET['subject']);
$Database->execute();
$subject = $Database->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($subject) {
        $choice = filter_var($_POST['choice'], FILTER_SANITIZE_STRING);
        $prompt = filter_var($_POST['prompt'], FILTER_SANITIZE_STRING);

        $Database = $dbh->prepare("INSERT INTO choices (choice, prompt) VALUES (:choice, :prompt)");
        $Database->bindParam(':choice', $choice);
        $Database->bindParam(':prompt', $prompt);
        $Database->execute();

        $Database = $dbh->prepare("SELECT id FROM choices WHERE choice = :choice");
        $Database->bindParam(':choice', $choice);
        $Database->execute();
        $choiceId = $Database->fetch(PDO::FETCH_ASSOC);

        $Database = $dbh->prepare("INSERT INTO tags (subject_id, choice_id) VALUES (:subject_id, :choice_id)");
        $Database->bindParam(':subject_id', $_GET['subject']);
        $Database->bindParam(':choice_id', $choiceId['id']);
        $Database->execute();

        header("Location: ../homepage.php");
        die;
    } else {
        $subject = filter_var($_POST['subjects'], FILTER_SANITIZE_STRING);
        $prompt = filter_var($_POST['prompt'], FILTER_SANITIZE_STRING);

        $Database = $dbh->prepare("INSERT INTO subjects (subject, prompt, images) VALUES (:subject, :prompt, NULL)");
        $Database->bindParam(':subject', $subject);
        $Database->bindParam(':prompt', $prompt);
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
    <title>add prompts</title>
</head>
<body>
    <nav class="right-button-login">
        <a href="../login-logout/logout.php"><button class="login-button">Logout</button></a>
        <a href="../homepage.php"><button class="back">Back</button></a>
    </nav>
    <div class="title-center-home">
         <?php if ($subject) { ?> 
            <h1>Add a prompt for <?= $subject['subject'];?></h1>
        <?php } else { ?>
            <h1>Add a subject</h1>
        <?php } ?>
    </div>
    <div class="center-boxes">
        <div class="boxes">
            <form method="post">
                <?php if ($subject) { ?>
                    <div class="space">
                        <label for="choice">Write new choice:</label>
                        <input type="text" name="choice" id="choice">
                    </div>
                    <div class="space">
                        <label for="prompt">Write new prompt:</label>
                        <input type="text" name="prompt" id="prompt">
                    </div>
                <?php } else { ?>
                    <div class="space">
                        <label for="subjects">Write new subject:</label>
                        <input type="text" name="subjects" id="subjects">
                    </div>
                    <div class="space">
                        <label for="prompt">Write new prompt:</label>
                        <input type="text" name="prompt" id="prompt">
                    </div>
                <?php } ?>
                <input type="submit" value="Submit">
            </form>
        </div>
    </div>
</body>
</html>