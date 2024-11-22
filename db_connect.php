<?php
// Database connection file

$servername = "localhost"; // Update with your database server
$username = "root"; // Update with your MySQL username
$password = ""; // Update with your MySQL password
$dbname = "FitInspireDB"; // Ensure this matches your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

