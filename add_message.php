<?php  
session_start();
$message = $_POST['command']; // Retrieve the message content from the request
$_SESSION['msg'] = $_POST['command'];
// Add the message to the database or any other storage
echo $message; // Replace with your own logic to add the message

// Return a response to indicate success or failure
// echo 'Message added successfully';
?>