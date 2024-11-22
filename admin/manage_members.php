<?php
session_start();
if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1) {
    header("Location: ../auth/login.php");
    exit;
}

include '../includes/db_connect.php';

// Handle deletion
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM Members WHERE member_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        echo "<p>Member deleted successfully!</p>";
    } else {
        echo "<p>Error deleting member: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

// Fetch members
$sql = "SELECT * FROM Members";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Members</title>
</head>
<body>
    <header>
        <h1>Manage Members</h1>
        <nav>
            <ul>
                <li><a href="index.php">Dashboard</a></li>
                <li><a href="../auth/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Current Members</h2>
        <table border="1">
            <tr>
                <th>Member ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['user_id'] ?></td>
                <td><?= $row['first_name'] . ' ' . $row['last_name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['phone_number'] ?></td>
                <td>
                    <a href="edit_member.php?member_id=<?= $row['member_id'] ?>">Edit</a> | 
                    <a href="manage_members.php?delete_id=<?= $row['member_id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>

        <h2>Add New Member</h2>
        <form action="add_member.php" method="post">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required><br>
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" required><br>
            <label for="membership_type">Membership Type:</label>
            <select name="membership_type" id="membership_type">
                <?php
                $membership_sql = "SELECT * FROM Memberships";
                $membership_result = $conn->query($membership_sql);
                while ($membership = $membership_result->fetch_assoc()): ?>
                    <option value="<?= $membership['membership_id'] ?>"><?= $membership['membership_type'] ?></option>
                <?php endwhile; ?>
            </select><br>
            <button type="submit">Add Member</button>
        </form>
    </main>
</body>
</html>
<?php $conn->close(); ?>
