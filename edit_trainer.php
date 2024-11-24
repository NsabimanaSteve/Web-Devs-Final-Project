<?php
// Include the database connection
include('../db_connect.php'); 

$error_message = "";
$success_message = "";

// Initialize variables to avoid undefined variable warnings
$first_name = $last_name = $email = $specialization = $fun_fact = $favorite_quote = $image_id = '';
$trainer_id = $user_id = 0;

// Fetch existing trainer data based on trainer_id from the URL
if (isset($_GET['trainer_id'])) {
    $trainer_id = $_GET['trainer_id'];

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to fetch trainer and associated user details
    $trainer_query = "SELECT t.trainer_id, t.specialization, t.fun_fact, t.favorite_quote, t.image_id, 
                    u.user_id, u.first_name, u.last_name, u.email 
                FROM Trainers t
                JOIN Users u ON t.user_id = u.user_id
                WHERE t.trainer_id = ?";

    $stmt = $conn->prepare($trainer_query);

    // Check if preparation of query failed
    if ($stmt === false) {
        die("Error preparing query: " . $conn->error . " - Query: " . $trainer_query);
    }

    $stmt->bind_param("i", $trainer_id);  // Bind the trainer_id parameter
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $trainer_data = $result->fetch_assoc();

        // Pre-fill form fields with the trainer and user data
        $trainer_id = $trainer_data['trainer_id'];
        $first_name = $trainer_data['first_name']; // Fixed typo: 'fisrt_name' to 'first_name'
        $last_name = $trainer_data['last_name'];
        $email = $trainer_data['email'];
        $specialization = $trainer_data['specialization'];
        $fun_fact = $trainer_data['fun_fact'];
        $favorite_quote = $trainer_data['favorite_quote'];
        $user_id = $trainer_data['user_id'];
        $image_id = $trainer_data['image_id'];
    } else {
        $error_message = "Trainer not found!";
    }

    $stmt->close();
    $conn->close();
}

// Update trainer and user details when the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $trainer_id = $_POST['trainer_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $specialization = $_POST['specialization'];
    $fun_fact = $_POST['fun_fact'];
    $favorite_quote = $_POST['favorite_quote'];
    $user_id = $_POST['user_id']; // The user_id of the associated user
    $image_id = $_POST['image_id']; // Optional image reference

    // Create a connection to the database
    //$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Begin a transaction to ensure both updates happen together
    $conn->begin_transaction();

    try {
        // Update the trainer's details
        $update_trainer_query = "UPDATE Trainers SET specialization = ?, fun_fact = ?, favorite_quote = ?, image_id = ? WHERE trainer_id = ?";
        $stmt = $conn->prepare($update_trainer_query);

        // Check if preparation of query failed
        if ($stmt === false) {
            die("Error preparing query: " . $conn->error . " - Query: " . $update_trainer_query);
        }

        $stmt->bind_param("sssii", $specialization, $fun_fact, $favorite_quote, $image_id, $trainer_id);
        $stmt->execute();

        // Check for errors during execution
        if ($stmt->errno) {
            die("Execution failed: " . $stmt->error);
        }

        // Update the user's details (first name, last name, email)
        $update_user_query = "UPDATE Users SET first_name = ?, last_name = ?, email = ? WHERE user_id = ?";
        $stmt = $conn->prepare($update_user_query);

        // Check if preparation of query failed
        if ($stmt === false) {
            die("Error preparing query: " . $conn->error . " - Query: " . $update_user_query);
        }

        $stmt->bind_param("sssi", $first_name, $last_name, $email, $user_id);
        $stmt->execute();

        // Check for errors during execution
        if ($stmt->errno) {
            die("Execution failed: " . $stmt->error);
        }

        // Commit the transaction
        $conn->commit();
        header('Location: manage_members.php');
        
        $success_message = "Trainer details updated successfully!";

    } catch (Exception $e) {
        // Rollback the transaction in case of an error
        $conn->rollback();
        $error_message = "Error updating trainer details: " . $e->getMessage();
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
    <title>Edit Trainer</title>
</head>
<body>
    <h2>Edit Trainer</h2>

    <!-- Display error or success messages -->
    <?php if (!empty($error_message)): ?>
        <p style="color: red;"><?= htmlspecialchars($error_message) ?></p>
    <?php endif; ?>
    
    <?php if (!empty($success_message)): ?>
        <p style="color: green;"><?= htmlspecialchars($success_message) ?></p>
    <?php endif; ?>

    <form action="edit_trainer.php" method="POST">
        
        <!-- Hidden fields for trainer_id and user_id -->
        <input type="hidden" name="trainer_id" value="<?= htmlspecialchars($trainer_id) ?>">
        <input type="hidden" name="user_id" value="<?= htmlspecialchars($user_id) ?>">

        <label>First Name:</label>
        <input type="text" name="first_name" value="<?= htmlspecialchars($first_name) ?>" required><br>

        <label>Last Name:</label>
        <input type="text" name="last_name" value="<?= htmlspecialchars($last_name) ?>" required><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required><br>

        <label>Specialization:</label>
        <input type="text" name="specialization" value="<?= htmlspecialchars($specialization) ?>" required><br>

        <label>Fun Fact:</label>
        <input type="text" name="fun_fact" value="<?= htmlspecialchars($fun_fact) ?>"><br>

        <label>Favorite Quote:</label>
        <textarea name="favorite_quote"><?= htmlspecialchars($favorite_quote) ?></textarea><br>

        <label>Image ID (optional):</label>
        <input type="number" name="image_id" value="<?= htmlspecialchars($image_id) ?>"><br>

        <button type="submit">Update Trainer</button>
    </form>
</body>
</html>
