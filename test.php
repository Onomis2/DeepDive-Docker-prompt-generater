<?php
// OpenAI API credentials
define('OPENAI_API_KEY', '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');

$response = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userInput = trim($_POST['user_input']);

    if (!empty($userInput)) {
        // Call OpenAI API
        $apiResponse = callOpenAI($userInput);
        $response = $apiResponse ?? "Sorry, I couldn't process your request.";
    } else {
        $response = "Please enter something to ask!";
    }
}

// Function to call the OpenAI API
function callOpenAI($prompt)
{
    $url = 'https://api.openai.com/v1/chat/completions';
    $headers = [
        'Authorization: Bearer ' . OPENAI_API_KEY,
        'Content-Type: application/json'
    ];
    $postData = [
        'model' => 'gpt-3.5-turbo', // or 'gpt-4' if you have access
        'messages' => [
            ['role' => 'system', 'content' => 'You are ChatGPT, a helpful assistant.'],
            ['role' => 'user', 'content' => $prompt]
        ],
        'max_tokens' => 100,
        'temperature' => 0.7
    ];

    // Initialize cURL
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    echo $result;
    curl_close($ch);

    // Decode and return the response
    $responseData = json_decode($result, true);
    return $responseData['choices'][0]['message']['content'] ?? null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatGPT Assistant</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .chat-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .chat-container h1 {
            margin-bottom: 10px;
            font-size: 24px;
        }
        .chat-container form {
            display: flex;
            flex-direction: column;
        }
        .chat-container input[type="text"] {
            padding: 10px;
            font-size: 16px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .chat-container input[type="submit"] {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }
        .chat-container input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .response {
            margin-top: 10px;
            padding: 10px;
            background-color: #e9ecef;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <h1>ChatGPT Assistant</h1>
        <p><strong>ChatGPT:</strong> What is the subject you want to know more about?</p>
        <form method="POST">
            <input type="text" name="user_input" placeholder="Type your answer here..." required>
            <input type="submit" value="Submit">
        </form>
        <?php if (!empty($response)): ?>
            <div class="response">
                <strong>ChatGPT:</strong> <?php echo nl2br(htmlspecialchars($response)); ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
