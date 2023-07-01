<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "health_report";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind the SQL statement
$stmt = $conn->prepare("INSERT INTO users (name, age, weight, email, report) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sisss", $name, $age, $weight, $email, $report);

// Set parameters and execute the statement
$name = $_POST['name'];
$age = $_POST['age'];
$weight = $_POST['weight'];
$email = $_POST['email'];

// File upload handling
$report = '';
if (isset($_FILES['report']) && $_FILES['report']['error'] === UPLOAD_ERR_OK) {
    $report = file_get_contents($_FILES['report']['tmp_name']);
}

if ($stmt->execute()) {
    echo "User details and report inserted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
