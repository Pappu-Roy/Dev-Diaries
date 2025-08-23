<?php
// Start a session to manage user login status
session_start();

// Database credentials
$host = 'localhost';
$username = 'root'; // Default XAMPP username
$password = 'root';     // XAMPP password
$database = 'myblog';

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to redirect the user
function redirect($url) {
    header("Location: $url");
    exit();
}
?>
