<?php
include('db_connect.php');
$login_error = "";

LoginUser_Post();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap 4.5.2 CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f9;
        }

        .container {
            max-width: 400px;
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
    </style>
</head>
<body>
<?php include("NavMenu.php"); ?>
<!-- Login Form -->
<div class="container">
    <div class="card">
        <h3 class="text-center">Login</h3>
        <?php if ($login_error) { echo "<div class='alert alert-danger'>$login_error</div>"; } ?>
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
        <hr>
        <p class="text-center">Don't have an account? <a href="registration.php">Register here</a></p>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

<?php
function LoginUser_Post()
{
    // Start session to store user data
    session_start();
    global $login_error;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect form data
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Check if the email and password are provided
        if (empty($email) || empty($password)) {
            $login_error = "Please fill in both fields.";
        } else {
            // Call the function to authenticate user from the database
            if (authenticateUserFromDb($email, password: $password)) {
                // Successful login, store user data in session and redirect to LoginSuccessfull.php
                $_SESSION['user'] = getUserFromDb($email);  // Store user data in session
                header("Location: LoginSuccessfull.php");
                exit;
            } else {
                $login_error = "Invalid email or password.";
            }
        }
    }
}
// Function to authenticate user using the database
function authenticateUserFromDb($email, $password) {
    global $conn; // Use the global $conn for the database connection
    
    // Prepare SQL query to check if the email exists and if the password matches
    $stmt = $conn->prepare("SELECT * FROM Users WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if any row is returned
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        // Check if the password matches
        if ($password == $user['password']) {
            return true; // User authenticated successfully
        }
    }
    
    return false; // Invalid email or password
}

// Function to retrieve user data from the database
function getUserFromDb($email) {
    global $conn;
    
    // Prepare SQL query to get the user details
    $stmt = $conn->prepare("SELECT * FROM Users WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        return $result->fetch_assoc(); // Return the user data as an associative array
    }
    
    return null; // No user found
}

function retrieveFromJson(){
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect form data
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        // Check if the email and password are provided
        if (empty($email) || empty($password)) {
            $login_error = "Please fill in both fields.";
        } else {
            // Read the data from the JSON file
            $json_file = "JsonData/data.json";
            
            // Check if the file exists and is not empty
            if (file_exists($json_file)) {
                $existing_data = json_decode(file_get_contents($json_file), true);
                
                // Check if any user data exists
                if (empty($existing_data)) {
                    $login_error = "No users registered yet.";
                } else {
                    $found_user = false;
    
                    // Loop through all users in the JSON file
                    foreach ($existing_data as $user) {
                        if ($user['email'] === $email && $user['password'] === $password) {
                            // Successful login, store user data in session and redirect to LoginSuccessfull.php
                            $_SESSION['user'] = $user;  // Store user data in session
                            header("Location: LoginSuccessfull.php"); 
                            exit;
                        }
                    }
    
                    // If we exit the loop without finding a match, show an error
                    $login_error = "Invalid email or password.";
                }
            } else {
                $login_error = "No users found or the data file is missing.";
            }
        }
    }
}
?>
