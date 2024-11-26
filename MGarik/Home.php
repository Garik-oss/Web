<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Bootstrap 4.5.2 CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>

<?php include("NavMenu.php"); ?>

<?php 
    if (!isset($_SESSION['user'])) {
        echo "<div class='jumbotron'>
            <h1>Welcome to Our Website!</h1>
            <p>We are glad to have you here. Please feel free to explore and register to get started.</p>
            <a href='registration.php' class='btn btn-primary btn-lg'>Go to Registration Page</a>
        </div>";
    } else {
        include("UserDataCard.php");
    }
    
?>

<!-- Footer Section -->
<footer class="text-center py-4">
    <p>&copy; 2024 My Website. All rights reserved.</p>
</footer>

<!-- Bootstrap 4.5.2 JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
