<?php

require("connection.php");

session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['prompt'])) {
    $host = 'http://localhost'; // Docker container host
    $port = 11434;              // Port the Docker container is listening on
    $endpoint = '/api/generate'; // API endpoint for generating a response
    $url = $host . ':' . $port . $endpoint;

    // Data to send to the API
    $data = [
        'model' => 'llama3', // Replace with the specific model you want to use
        'prompt' => $_POST['prompt'], // Prompt from the form
        'stream' => false
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
    curl_setopt($ch, CURLOPT_WRITEFUNCTION, function($curl, $data) use (&$json_data) {
        header('Content-Type: application/json');
        echo $data;
        exit();

        return strlen($data); // Return the size of the raw data
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