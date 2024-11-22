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
            <textarea name="" id="prompt"></textarea>
            <button class="send">Send</button>
        </div>
        <div class="boxes" id="response-box">
            <p id="response-text">The AI's response will appear here.</p>
            <button id="copy-button" style="display:none;">Copy to Clipboard</button>
            <a href="#" id="open-chatgpt-link" style="display:none;"><button id="open-button">Open with ChatGPT</button></a>
        </div>
    </div>
    <script>
    document.querySelector('.send')
        .addEventListener('click', () => {
            const inputElement = document.getElementById('prompt');
            const predefinedStart = "Rephrase this message into a concise AI prompt that outputs only the necessary information for a clear and actionable response. Provide the following prompt without any extra explanation or introduction: '";
            const predefinedEnd = "'";

            const modifiedValue = predefinedStart + inputElement.value + predefinedEnd;

            const responseBox = document.getElementById('response-box');
            const responseText = document.getElementById('response-text');
            const copyButton = document.getElementById('copy-button');
            const openButton = document.getElementById('open-chatgpt-link');

            responseText.textContent = "Regenerating prompt...";
            copyButton.style.display = "none";  // Hide the button while waiting for response

            // Update the 'Open with ChatGPT' button link dynamically
            const chatGptUrl = `https://chatgpt.com/?q=${encodeURIComponent(modifiedValue)}`;
            document.getElementById('open-chatgpt-link').setAttribute('href', chatGptUrl);

            // Show the 'Open with ChatGPT' button only after response is available
            openButton.style.display = "none";

            const data = new URLSearchParams();
            data.append('prompt', modifiedValue);
            fetch('ai_api.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: data
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);

                // Update the AI response
                responseText.textContent = data.response;

                // Show the copy button after response is available
                copyButton.style.display = "inline-block";

                // Show the 'Open with ChatGPT' button after response is available
                openButton.style.display = "inline-block";

                // Update the 'Open with ChatGPT' link with the response from the API
                const chatGptResponseUrl = `https://chatgpt.com/?q=${encodeURIComponent(data.response)}`;
                document.getElementById('open-chatgpt-link').setAttribute('href', chatGptResponseUrl);

                // Clear the input if needed
                inputElement.value = '';
            })
            .catch(error => {
                console.error('Error:', error);
                responseText.textContent = "An error occurred. Please try again.";
            });
        });

    document.getElementById('copy-button').addEventListener('click', () => {
        const responseText = document.getElementById('response-text').textContent;

        // Use the Clipboard API to copy the response text
        navigator.clipboard.writeText(responseText)
            .then(() => {
                alert("Copied to clipboard!");
            })
            .catch(error => {
                console.error("Error copying to clipboard: ", error);
            });
    });
    </script>
</body>
</html>
