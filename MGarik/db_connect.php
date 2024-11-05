<?php
// Database credentials
$servername = "localhost"; // Typically localhost
$username = "root"; // MySQL username (use your own if different)
$password = ""; // MySQL password (default is empty for local development)
$dbname = "hg_db"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
