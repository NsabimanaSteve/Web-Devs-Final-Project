<?php
// Include the database connection
include('../db_connect.php');

// Get the 'delete_id' and 'is_trainer' from the URL
$delete_id = $_GET['delete_id'] ?? null;
$is_trainer = $_GET['is_trainer'] ?? null;

// Validate the parameters
if (!$delete_id || !$is_trainer) {
    echo 'Invalid request';
    exit;  // Stop further execution if parameters are missing
}

// If deleting a trainer
if ($is_trainer == 1) {
    // Delete the trainer record
    $stmt = $conn->prepare('DELETE FROM Trainers WHERE trainer_id = ?');
    $stmt->bind_param('i', $delete_id); // Bind the integer parameter
    if ($stmt->execute()) {
        // Get the associated user_id from Trainers table
        $stmt_get_user = $conn->prepare('SELECT user_id FROM Trainers WHERE trainer_id = ?');
        $stmt_get_user->bind_param('i', $delete_id);
        $stmt_get_user->execute();
        $stmt_get_user->bind_result($user_id);
        $stmt_get_user->fetch();
        $stmt_get_user->close();

        // Now delete the associated user from Users table if found
        if ($user_id) {
            $stmt_delete_user = $conn->prepare('DELETE FROM Users WHERE user_id = ?');
            $stmt_delete_user->bind_param('i', $user_id);
            $stmt_delete_user->execute();
            $stmt_delete_user->close();
        }

        // Redirect to manage_members.php after successful deletion
        header('Location: manage_members.php');
        exit; // Make sure to exit after the redirect to stop further execution
    } else {
        echo 'Error deleting trainer';
    }
} else {
    echo 'Invalid action type specified';
}
?>
