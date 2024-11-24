<?php
// Include the database connection
include('../db_connect.php');

$error_message = "";
$success_message = "";

// Initialize variables to avoid undefined variable warnings
$first_name = $last_name = $email = '';
$membership_id = $member_id = $user_id = 0;

// Fetch existing member data based on member_id from the URL
if (isset($_GET['member_id'])) {
    $member_id = $_GET['member_id'];

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to fetch member and associated user and membership details
    $member_query = "SELECT m.member_id, m.membership_id, u.user_id, u.first_name, u.last_name, u.email
                     FROM Members m
                     JOIN Users u ON m.user_id = u.user_id
                     WHERE m.member_id = ?";

    $stmt = $conn->prepare($member_query);

    // Check if preparation of the query failed
    if ($stmt === false) {
        die("Error preparing query: " . $conn->error . " - Query: " . $member_query);
    }

    $stmt->bind_param("i", $member_id);  // Bind the member_id parameter
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $member_data = $result->fetch_assoc();

        // Pre-fill form fields with the member and user data
        $member_id = $member_data['member_id'];
        $first_name = $member_data['first_name'];
        $last_name = $member_data['last_name'];
        $email = $member_data['email'];
        $membership_id = $member_data['membership_id'];
        $user_id = $member_data['user_id'];
    } else {
        $error_message = "Member not found!";
    }

    $stmt->close();
    $conn->close();
}

// Update member and user details when the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $member_id = $_POST['member_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $membership_id = $_POST['membership_id'];
    $user_id = $_POST['user_id'];

    // Check connection again before updating
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Begin a transaction to ensure both updates happen together
    $conn->begin_transaction();

    try {
        // Update the member's details (membership_id is updated here)
        $update_member_query = "UPDATE Members SET membership_id = ? WHERE member_id = ?";
        $stmt = $conn->prepare($update_member_query);

        // Check if preparation of the query failed
        if ($stmt === false) {
            die("Error preparing query: " . $conn->error . " - Query: " . $update_member_query);
        }

        $stmt->bind_param("ii", $membership_id, $member_id);
        $stmt->execute();

        // Check for errors during execution
        if ($stmt->errno) {
            die("Execution failed: " . $stmt->error);
        }

        // Update the user's details (first name, last name, email)
        $update_user_query = "UPDATE Users SET first_name = ?, last_name = ?, email = ? WHERE user_id = ?";
        $stmt = $conn->prepare($update_user_query);

        // Check if preparation of the query failed
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
        exit;

        $success_message = "Member details updated successfully!";

    } catch (Exception $e) {
        // Rollback the transaction in case of an error
        $conn->rollback();
        $error_message = "Error updating member details: " . $e->getMessage();
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
    <title>Edit Member</title>
</head>
<body>
    <h2>Edit Member</h2>

    <!-- Display error or success messages -->
    <?php if (!empty($error_message)): ?>
        <p style="color: red;"><?= htmlspecialchars($error_message) ?></p>
    <?php endif; ?>
    
    <?php if (!empty($success_message)): ?>
        <p style="color: green;"><?= htmlspecialchars($success_message) ?></p>
    <?php endif; ?>

    <form action="edit_member.php" method="POST">
        
        <!-- Hidden fields for member_id and user_id -->
        <input type="hidden" name="member_id" value="<?= htmlspecialchars($member_id) ?>">
        <input type="hidden" name="user_id" value="<?= htmlspecialchars($user_id) ?>">

        <label>First Name:</label>
        <input type="text" name="first_name" value="<?= htmlspecialchars($first_name) ?>" required><br>

        <label>Last Name:</label>
        <input type="text" name="last_name" value="<?= htmlspecialchars($last_name) ?>" required><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required><br>

        <label>Membership Type:</label>
        <select name="membership_id" required>
            <!-- Dynamically populate the membership types -->
            <?php
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch all membership types
                $membership_query = "SELECT membership_id, membership_name FROM Memberships";
                $result = $conn->query($membership_query);

                if ($result->num_rows > 0) {
                    while ($membership = $result->fetch_assoc()) {
                        echo "<option value='" . $membership['membership_id'] . "'"
                            . ($membership['membership_id'] == $membership_id ? " selected" : "") . ">"
                            . $membership['membership_name'] . "</option>";
                    }
                } else {
                    echo "<option>No membership types available</option>";
                }
            ?>
        </select><br>

        <!-- Submit button -->
        <button type="submit">Update Member</button>
    </form>
</body>
</html>
