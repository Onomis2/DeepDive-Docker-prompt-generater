<?php

$json_data['response'] = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['prompt'])) {
    $host = 'http://localhost'; // Docker container host
    $port = 11434;              // Port the Docker container is listening on
    $endpoint = '/api/generate'; // API endpoint for generating a response
    $url = $host . ':' . $port . $endpoint;

    // Data to send to the API
    $data = [
        'model' => 'llama3', // Replace with the specific model you want to use
        'prompt' => $_POST['prompt'] // Prompt from the form
    ];

    // Initialize cURL
    $ch = curl_init();

    // Configure cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true); // Use POST for sending data
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // Send JSON data
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
    ]);

    // Set up a callback function to handle data as it arrives
    curl_setopt($ch, CURLOPT_WRITEFUNCTION, function($curl, $data) {
        // Decode the incoming JSON response
        $json_data = json_decode($data, true);

        // Check if the 'response' key exists and echo its value
        if (isset($json_data['response'])) {
            echo $json_data['response'];  // Output only the 'response' field
            flush();  // Send the data immediately
        }
        return strlen($data); // Return the size of the data
    });

    // Execute cURL request (this will now stream the response in real-time)
    curl_exec($ch);

    // Check for errors after the request
    if (curl_errno($ch)) {
        echo 'cURL error: ' . curl_error($ch) . "\n";
    }

    // Close cURL session
    curl_close($ch);
}
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
<div class="center-boxes">
    <div class="boxes">
        <form method="POST">
            <label for="prompt">Enter Prompt:</label>
            <input type="text" name="prompt" id="prompt" required>
            <input type="submit" value="Submit">
        </form>
        <p><?=$json_data['response'];?></p>
    </div>
</div>
</body>
</html>