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
    $sql = "DELETE FROM Classes WHERE class_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        echo "<p>Class deleted successfully!</p>";
    } else {
        echo "<p>Error deleting class: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

// Fetch classes
$sql = "SELECT c.*, t.first_name, t.last_name FROM Classes c LEFT JOIN Trainers t ON c.instructor_id = t.trainer_id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Classes</title>
</head>
<body>
    <header>
        <h1>Manage Classes</h1>
        <nav>
            <ul>
                <li><a href="index.php">Dashboard</a></li>
                <li><a href="../auth/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Current Classes</h2>
        <table border="1">
            <tr>
                <th>Class ID</th>
                <th>Class Name</th>
                <th>Instructor</th>
                <th>Schedule</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['class_id'] ?></td>
                <td><?= $row['class_name'] ?></td>
                <td><?= $row['first_name'] . ' ' . $row['last_name'] ?></td>
                <td><?= $row['schedule_date'] . ' ' . $row['start_time'] ?></td>
                <td>
                    <a href="edit_class.php?class_id=<?= $row['class_id'] ?>">Edit</a> | 
                    <a href="manage_classes.php?delete_id=<?= $row['class_id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>

        <h2>Add New Class</h2>
        <form action="add_class.php" method="post">
            <label for="class_name">Class Name:</label>
            <input type="text" id="class_name" name="class_name" required><br>
            <label for="instructor_id">Instructor:</label>
            <select name="instructor_id" id="instructor_id">
                <?php
                $trainer_sql = "SELECT * FROM Trainers";
                $trainer_result = $conn->query($trainer_sql);
                while ($trainer = $trainer_result->fetch_assoc()): ?>
                    <option value="<?= $trainer['trainer_id'] ?>"><?= $trainer['first_name'] . ' ' . $trainer['last_name'] ?></option>
                <?php endwhile; ?>
            </select><br>
            <label for="schedule_date">Date:</label>
            <input type="date" id="schedule_date" name="schedule_date" required><br>
            <label for="start_time">Start Time:</label>
            <input type="time" id="start_time" name="start_time" required><br>
            <button type="submit">Add Class</button>
        </form>
    </main>
</body>
</html>
<?php $conn->close(); ?>
