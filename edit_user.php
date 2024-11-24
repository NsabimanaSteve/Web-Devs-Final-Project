<?php
// Include the database connection
include('../db_connect.php'); 

// Initialize variables
$error_message = "";
$user_id = 0;

// Fetch the user ID from the URL to edit user data
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to fetch user details
    $user_query = "SELECT u.user_id, u.first_name, u.last_name, u.email, u.role_id 
                   FROM Users u
                   WHERE u.user_id = ?";

    $stmt = $conn->prepare($user_query);

    // Check if preparation of query failed
    if ($stmt === false) {
        die("Error preparing query: " . $conn->error . " - Query: " . $user_query);
    }

    $stmt->bind_param("i", $user_id);  // Bind the user_id parameter
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();

        // Pre-fill form fields with the user data
        $user_id = $user_data['user_id'];
        $first_name = $user_data['first_name']; 
        $last_name = $user_data['last_name'];
        $email = $user_data['email'];
        $role_id = $user_data['role_id'];
    } else {
        $error_message = "User not found!";
    }

    $stmt->close();
}

// Update user details when the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $role_id = $_POST['role_id'];

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Begin a transaction to ensure the update happens atomically
    $conn->begin_transaction();

    try {
        // Update the user details
        $update_user_query = "UPDATE Users SET first_name = ?, last_name = ?, email = ?, role_id = ? WHERE user_id = ?";
        $stmt = $conn->prepare($update_user_query);

        if ($stmt === false) {
            throw new Exception("Error preparing query: " . $conn->error);
        }

        $stmt->bind_param("ssssi", $first_name, $last_name, $email, $role_id, $user_id);
        $stmt->execute();

        if ($stmt->errno) {
            throw new Exception("Execution failed: " . $stmt->error);
        }

        // Commit the transaction
        $conn->commit();

        // Redirect to the previous page (manage_classes.php) after the update is successful
        header('Location: manage_members.php');
        exit;

    } catch (Exception $e) {
        // Rollback the transaction in case of an error
        $conn->rollback();
        $error_message = "Error updating user details: " . $e->getMessage();
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>

    <!-- Display error message if any -->
    <?php if (!empty($error_message)): ?>
        <p style="color: red;"><?= htmlspecialchars($error_message) ?></p>
    <?php endif; ?>

    <form action="edit_user.php" method="POST">
        
        <!-- Hidden field for user_id -->
        <input type="hidden" name="user_id" value="<?= htmlspecialchars($user_id) ?>">

        <label>First Name:</label>
        <input type="text" name="first_name" value="<?= htmlspecialchars($first_name) ?>" required><br>

        <label>Last Name:</label>
        <input type="text" name="last_name" value="<?= htmlspecialchars($last_name) ?>" required><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required><br>

        <label>Role ID:</label>
        <input type="number" name="role_id" value="<?= htmlspecialchars($role_id) ?>" required><br>

        <button type="submit">Update User</button>
    </form>
</body>
</html>
