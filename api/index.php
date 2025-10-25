<?php
// Set the content type to JSON, as this file acts as an API endpoint
header("Content-Type: application/json");

// Define a simple structure for the API response
$response = [
    'message' => 'Hello from the Vercel PHP Serverless Function!',
    'timestamp' => time(),
    'method' => $_SERVER['REQUEST_METHOD'],
    'path' => $_SERVER['REQUEST_URI']
];

// Handle different HTTP methods (e.g., GET, POST)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // If it's a GET request, you might check for query parameters
    if (isset($_GET['name'])) {
        $name = htmlspecialchars($_GET['name']);
        $response['greeting'] = "Hello, $name! This is a dynamic GET response.";
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // If it's a POST request, you can read the request body
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);
    
    $response['greeting'] = 'Received a POST request.';
    if ($data) {
        $response['received_data'] = $data;
    } else {
        $response['received_data'] = 'No JSON data received.';
    }
}

// Output the JSON response
echo json_encode($response, JSON_PRETTY_PRINT);

// Exit to ensure no stray output contaminates the response
exit;