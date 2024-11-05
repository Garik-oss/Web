<?php

function saveToJsonFile($data) {
    // JSON folder where the data will be stored
    $json_folder = "JsonData/";

    // Create the folder if it doesn't exist
    if (!file_exists($json_folder)) {
        mkdir($json_folder, 0777, true);
    }

    // Path to the JSON file
    $json_file = $json_folder . "data.json";

    // Read existing data from JSON file if it exists
    if (file_exists($json_file)) {
        $existing_data = json_decode(file_get_contents($json_file), true);
    } else {
        $existing_data = []; // If the file doesn't exist, start with an empty array
    }

    // Add the new entry to the existing data
    $existing_data[] = $data;

    // Write the updated data back to the JSON file
    if (file_put_contents($json_file, json_encode($existing_data, JSON_PRETTY_PRINT))) {
        echo "<div class='alert alert-success'>Registration data saved in JSON format!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error saving data to JSON.</div>";
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];  // Consider hashing passwords for security
    $confirm_password = $_POST['confirm_password'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $country = $_POST['country'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "<div class='alert alert-danger'>Passwords do not match!</div>";
    } else {
        // Handle file upload
        $file_uploaded = false;
        $upload_dir = "uploads/"; // Directory to store uploaded files

        if (isset($_FILES['file_upload'])) {
            $file_name = $_FILES['file_upload']['name'];
            $file_tmp = $_FILES['file_upload']['tmp_name'];
            $file_size = $_FILES['file_upload']['size'];
            $file_error = $_FILES['file_upload']['error'];
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            // Allowed file extensions
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'pdf', 'txt', 'csv'];

            // Validate file extension
            if (in_array($file_ext, $allowed_extensions)) {
                // Validate file size (max 5MB)
                if ($file_size <= 5000000) {
                    // Ensure the upload directory exists
                    if (!file_exists($upload_dir)) {
                        mkdir($upload_dir, 0777, true);
                    }

                    // Generate a unique file name to avoid conflicts
                    $file_new_name = uniqid('', true) . "." . $file_ext;

                    // Move the uploaded file to the uploads directory
                    if (move_uploaded_file($file_tmp, $upload_dir . $file_new_name)) {
                        $file_uploaded = true;
                        echo "<div class='alert alert-danger'>File saved!</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Error uploading file.</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>File is too large. Max size is 5MB.</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Invalid file type. Only JPG, PNG, and PDF are allowed.</div>";
            }
        }

        // Prepare data for CSV (convert to an array)
        $data = [
            $first_name,
            $last_name,
            $email,
            $password,  // In a real scenario, hash the password
            $dob,
            $gender,
            $country,
            $file_uploaded ? $file_new_name : "No file uploaded"
        ];
        //for json
        $registration_data = [
            "first_name" => $first_name,
            "last_name" => $last_name,
            "email" => $email,
            "password" => $password,  // In a real scenario, hash the password
            "dob" => $dob,
            "gender" => $gender,
            "country" => $country,
            "file_uploaded" => $file_uploaded ? $file_new_name : "No file uploaded"
        ];

        // Open the CSV file for appending
        $file = fopen("Data.csv", "a");

        // Write the data to the CSV file
        if ($file) {
            // If the file is empty, add a header row first (optional)
            if (filesize("Data.csv") == 0) {
                fputcsv($file, ["First Name", "Last Name", "Email", "Password", "Date of Birth", "Gender", "Country", "File"]);
            }

            // Write the user data to the CSV file
            fputcsv($file, $data);

            // Close the file
            fclose($file);

            echo "<div class='alert alert-success'>Registration successful!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error opening the file.</div>";
        }        

        saveToJsonFile($registration_data);
    }
}
?>
<div class='alert alert-info mt-4'>
    <a href='home.php' class='btn btn-primary'>Go to Home</a>
</div>
