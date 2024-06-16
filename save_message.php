<?php
// Get the username and message from POST data
$username = $_POST['username'];
$message = $_POST['message'];

// Define the file to save messages
$file = 'messages.json';

// Read existing messages from file
$currentMessages = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

// Create a new message object
$newMessage = [
    'username' => $username,
    'message' => $message,
    'timestamp' => date('Y-m-d H:i:s') // Add timestamp
];

// Add the new message to the array of messages
$currentMessages[] = $newMessage;

// Limit messages to 1000 (adjust as needed)
if (count($currentMessages) > 1000) {
    $currentMessages = array_slice($currentMessages, -1000, null, true);
}

// Save updated messages back to file
file_put_contents($file, json_encode($currentMessages, JSON_PRETTY_PRINT));

// Return success response
echo json_encode(['status' => 'success']);
?>
