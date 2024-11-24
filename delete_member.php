<?php
// Include the database connection
include('../db_connect.php');

// Get the 'member_id' from the URL
$member_id = $_GET['member_id'] ?? null;

// Validate the parameter
if (!$member_id || !is_numeric($member_id)) {
    echo 'Invalid member ID';
    exit; // Stop further execution if the parameter is invalid
}

// Check if the member exists in the Members table
$stmt = $conn->prepare('SELECT * FROM members WHERE member_id = ?');
$stmt->bind_param('i', $member_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo 'Member not found';
    exit; // Stop further execution if the member doesn't exist
}

// Optionally, delete the related user record (if any) from the Users table
$stmt = $conn->prepare('DELETE FROM Users WHERE user_id = (SELECT user_id FROM members WHERE member_id = ?)');
$stmt->bind_param('i', $member_id);
$stmt->execute();

// Now delete the member from the Members table
$stmt = $conn->prepare('DELETE FROM members WHERE member_id = ?');
$stmt->bind_param('i', $member_id);

if ($stmt->execute()) {
    // Redirect to the manage_members page after successful deletion
    header('Location: manage_members.php');
    exit;
} else {
    echo 'Error deleting member: ' . $stmt->error;
}

// Close the statement
$stmt->close();

// Close the connection
$conn->close();
?>
