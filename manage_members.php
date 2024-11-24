<?php
include('../db_connect.php'); 

if (!isset($conn)) {
    die("Database connection failed.");
}


// Handle deletion
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $table = isset($_GET['is_trainer']) ? 'Trainers' : (isset($_GET['is_member']) ? 'Members' : 'Users'); // Check if it's a trainer, user, or member to delete
    $sql = "DELETE FROM $table WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        echo "<p>Record deleted successfully!</p>";
    } else {
        echo "<p>Error deleting record: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

// Fetch users (from Users table)
$users_sql = "SELECT * FROM Users";
$users_result = $conn->query($users_sql);

// Fetch trainers (from Trainers table)
$trainers_sql = "SELECT * FROM Trainers INNER JOIN Users ON Trainers.user_id = Users.user_id";
$trainers_result = $conn->query($trainers_sql);

// Fetch members (from Members table, join with Users and Memberships table)
$members_sql = "SELECT Members.member_id, Users.first_name, last_name, Users.email, Memberships.membership_type FROM Members 
                JOIN Users ON Members.user_id = Users.user_id 
                LEFT JOIN Memberships ON Members.membership_id = Memberships.membership_id";
$members_result = $conn->query($members_sql);
// Check if the query was successful
if (!$members_result) {
    die("Error in query execution: " . $conn->error);  // Display the error message from the database
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users, Trainers, and Members</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        a {
            text-decoration: none;
            color: #4CAF50;
        }
        a:hover {
            text-decoration: underline;
        }
        form {
            margin: 20px auto;
            width: 80%;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        form label {
            display: block;
            margin-bottom: 8px;
        }
        form input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>Manage Users, Trainers, and Members</h1>
        <nav>
            <ul>
                <li><a href="index.php">Dashboard</a></li>
                <li><a href="../auth/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <!-- Manage Users -->
        <h2>Current Users</h2>
        <table>
            <tr>
                <th>User ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Account Created At</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $users_result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['user_id']) ?></td>
                <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['role_id']) ?></td>
                <td><?= htmlspecialchars($row['created_at']) ?></td>
                <td>
                    <a href="edit_user.php?user_id=<?= $row['user_id'] ?>">Edit</a> | 
                    <a href="delete_user.php?delete_email=<?= urlencode($row['email']) ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>

        <!-- Manage Trainers -->
        <h2>Current Trainers</h2>
        <table>
            <tr>
                <th>User ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Specialization</th>
                <th>Fun Fact</th>
                <th>Favorite Quote</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $trainers_result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['user_id']) ?></td>
                <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['specialization']) ?></td>
                <td><?= htmlspecialchars($row['fun_fact'] ?? 'N/A') ?></td>
                <td><?= htmlspecialchars($row['favorite_quote'] ?? 'N/A') ?></td>

                
                <td>
                    <a href="edit_trainer.php?trainer_id=<?= $row['trainer_id'] ?>">Edit</a> | 
                    <a href="delete_trainer.php?delete_id=<?= $row['trainer_id'] ?>&is_trainer=1" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>

        <!-- Manage Members -->
        <h2>Current Members</h2>
        <table>
            <tr>
                <th>Member ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Membership Type</th>
            </tr>
            <?php while ($row = $members_result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['member_id']) ?></td>
                <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['membership_type']) ?></td>
                
            </tr>
            <?php endwhile; ?>
        </table>

    </main>
</body>
</html>
