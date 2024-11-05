<?php
// Start the session to access the user data
session_start();

// Check if the user is logged in by checking session data
if (!isset($_SESSION['user'])) {
    header("Location: login.php");  // Redirect to login page if not logged in
    exit;
}

// Get the logged-in user data
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Successful</title>
    <!-- Bootstrap 4.5.2 CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f9;
            color: #333;
        }

        .container {
            margin-top: 100px;
        }

        .card {
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .btn-logout {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-logout:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
</head>
<body>

<!-- Welcome Section -->
<div class="container">
    <div class="card">
        <h3 class="text-center">Welcome, <?php echo htmlspecialchars($user['first_name']); ?>!</h3>
        <p class="text-center">You are logged in successfully!</p>

        <!-- User Info -->
        <ul class="list-group">
            <li class="list-group-item"><strong>First Name:</strong> <?php echo htmlspecialchars($user['first_name']); ?></li>
            <li class="list-group-item"><strong>Last Name:</strong> <?php echo htmlspecialchars($user['last_name']); ?></li>
            <li class="list-group-item"><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></li>
            <li class="list-group-item"><strong>Date of Birth:</strong> <?php echo htmlspecialchars($user['dob']); ?></li>
            <li class="list-group-item"><strong>Gender:</strong> <?php echo htmlspecialchars($user['gender']); ?></li>
            <li class="list-group-item"><strong>Country:</strong> <?php echo htmlspecialchars($user['country']); ?></li>
            <li class="list-group-item"><strong>File Uploaded:</strong> <?php echo htmlspecialchars($user['file_uploaded']); ?></li>
        </ul>

        <hr>

        <!-- Logout Button -->
        <div class="text-center">
            <a href="logout.php" class="btn btn-logout">Logout</a>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
