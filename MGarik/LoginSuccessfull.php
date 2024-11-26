<?php
// Start the session to access the user data
session_start();

// Check if the user is logged in by checking session data
if (!isset($_SESSION['user'])) {
    header("Location: login.php");  // Redirect to login page if not logged in
} else {
    // If the user is logged in, redirect them to the home page
    header("Location: Home.php");  // Or replace 'home.php' with the desired page
}
?>

