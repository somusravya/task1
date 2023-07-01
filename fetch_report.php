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

$email = $_GET['email'];

// Prepare and bind the SQL statement
$stmt = $conn->prepare("SELECT report FROM users WHERE email = ?");
$stmt->bind_param("s", $email);

// Execute the statement
$stmt->execute();

$stmt->store_result();

// Bind the result to a variable
$stmt->bind_result($report);

if ($stmt->num_rows > 0) {
    $stmt->fetch();
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="report.pdf"');
    echo $report;
} else {
    echo "Report not found.";
}

$stmt->close();
$conn->close();
?>
