<?php
// Include the database connection
include('../db_connect.php');

// Get the 'delete_email' from the URL
$delete_email = $_GET['delete_email'] ?? null;

// Validate the parameter
if (!$delete_email || !filter_var($delete_email, FILTER_VALIDATE_EMAIL)) {
    echo 'Invalid email address';
    exit; // Stop further execution if the parameter is invalid
}

// Debug: Check if the delete_email is valid
echo 'Delete Email: ' . $delete_email;  // Debugging line

// Check if the user exists in the Users table
$stmt = $conn->prepare('SELECT * FROM Users WHERE email = ?');
$stmt->bind_param('s', $delete_email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo 'User not found';
    exit; // Stop further execution if the user doesn't exist
}

// Optionally, delete the related trainer record (if any) from the Trainers table
$stmt = $conn->prepare('DELETE FROM Trainers WHERE user_id = (SELECT user_id FROM Users WHERE email = ?)');
$stmt->bind_param('s', $delete_email);
$stmt->execute();

// Now delete the user from the Users table
$stmt = $conn->prepare('DELETE FROM Users WHERE email = ?');
$stmt->bind_param('s', $delete_email);

if ($stmt->execute()) {
    // Redirect to the admin dashboard after successful deletion
    header('Location: manage_members.php');
    exit;
} else {
    echo 'Error deleting user: ' . $stmt->error;
}

// Close the statement
$stmt->close();

// Close the connection
$conn->close();
?>
