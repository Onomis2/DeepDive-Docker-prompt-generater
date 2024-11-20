<?php

require("connection.php");

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt_subject = $dbh->prepare("SELECT prompt FROM subjects WHERE id = :subject_id");
    $stmt_subject->bindParam(':subject_id', $_GET['subject'], PDO::PARAM_INT);
    $stmt_subject->execute();
    $subject_prompt = $stmt_subject->fetchColumn();

    $stmt_choice = $dbh->prepare("SELECT prompt FROM choices WHERE id = :choice_id");
    $stmt_choice->bindParam(':choice_id', $_GET['choice'], PDO::PARAM_INT);
    $stmt_choice->execute();
    $choice_prompt = $stmt_choice->fetchColumn();

    $user_prompt = htmlspecialchars($_POST['prompt'], ENT_QUOTES, 'UTF-8');
    $combined_paragraph = "$subject_prompt" . " " . "$choice_prompt" . " " . "$user_prompt";

    $prompt = nl2br($combined_paragraph);
    echo "<script>
        window.open('https://chatgpt.com/?q=" . urlencode($prompt) . "', '_blank');
        window.location.href = 'homepage.php';
    </script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>prompt</title>
</head>
<body>
    <nav class="right-button-login">
        <a href="login-logout/logout.php"><button class="login-button">Logout</button></a>
        <a href="choice.php?subject=<?= $_GET['subject']; ?>"><button class="back">Back</button></a>
    </nav>
    <div class="title-center-home">
        <h1>In one sentence, describe your request</h1>
    </div>
    <div class="center-boxes">
        <div class="boxes">
            <form method="post">
                <p>Note: Please include what you are working with in your sentence.</p>
                <input type="text" name="prompt" value="">
                <button class="back">Submit</button></a> 
            </form>
            <p>Examples:</p>
            <p>In javascript, I want to loop through an array and save the results in a seperate file</p>
            <p>Using cornstarch, I want to make fluffy omelets</p>
            <p>In my medieval fantasy story, add items that the evil merchant sells that do more harm than good</p>
            <p>what needle do I need to use to stitch a hole in my 100% polyester T-shirt</p>
        </div>
    </div>
</body>
</html>