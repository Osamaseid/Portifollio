<?php
// Set up our database connection
$host = "localhost";
$username = "db_username";
$password = "db_password";
$database = "example_db";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement
$stmt = $conn->prepare("SELECT id FROM guests WHERE email = ? AND password = ?");

// Bind parameters
$stmt->bind_param("ss", $email, $password);

// Get form data
$email = $_POST['email'];
$password = $_POST['password'];

// Execute SQL statement
$stmt->execute();
$stmt->store_result();

// If user is found, redirect to a restricted page
if ($stmt->num_rows == 1) {
    header("Location: restricted_page.php");
    exit();
} else {
    // Login failed, redirect back to login page
    header("Location: login.php");
    exit();
}

// Close statement and connection
$stmt->close();
$conn->close();
?>