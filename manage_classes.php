<?php
include('../db_connect.php'); 

if (!isset($conn)) {
    die("Database connection failed.");
}

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

// Insert new class into the database when form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['edit'])) {
    $class_name = $_POST['class_name'];
    $instructor_id = $_POST['instructor_id'];
    $schedule_time = $_POST['schedule_time'];
    $max_slots = $_POST['max_slots'];
    $available_slots = $_POST['available_slots'];

    $sql = "INSERT INTO Classes (class_name, trainer_id, schedule_time, max_slots, available_slots) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $class_name, $instructor_id, $schedule_time, $max_slots, $available_slots);

    if ($stmt->execute()) {
        // Redirect to manage_classes.php after successful insertion
        header('Location: manage_classes.php');
        exit();
    } else {
        echo "<p>Error adding class: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

// Edit class
if (isset($_POST['edit'])) {
    $class_id = $_POST['class_id'];
    $class_name = $_POST['class_name'];
    $instructor_id = $_POST['instructor_id'];
    $schedule_time = $_POST['schedule_time'];
    $max_slots = $_POST['max_slots'];
    $available_slots = $_POST['available_slots'];

    $sql = "UPDATE Classes 
            SET class_name = ?, trainer_id = ?, schedule_time = ?, max_slots = ?, available_slots = ? 
            WHERE class_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssii", $class_name, $instructor_id, $schedule_time, $max_slots, $available_slots, $class_id);

    if ($stmt->execute()) {
        // Redirect to manage_classes.php after successful edit
        header('Location: manage_classes.php');
        exit();
    } else {
        echo "<p>Error editing class: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

// Fetch classes
$sql = "SELECT c.class_id, c.class_name, c.schedule_time, c.max_slots, c.available_slots, c.trainer_id
        FROM Classes c 
        LEFT JOIN Trainers t ON c.trainer_id = t.trainer_id";
$result = $conn->query($sql);

if (!$result) {
    die("Error fetching classes: " . $conn->error);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Classes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        header {
            background: #333;
            color: #fff;
            padding: 10px 20px;
        }
        header h1 {
            margin: 0;
        }
        header nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
        }
        header nav ul li {
            margin-right: 15px;
        }
        header nav ul li a {
            color: #fff;
            text-decoration: none;
        }
        main {
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        table th {
            background: #333;
            color: #fff;
        }
        table tr:nth-child(even) {
            background: #f9f9f9;
        }
        form {
            background: #fff;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        form label {
            display: block;
            margin-bottom: 5px;
        }
        form input, form select, form button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        form button {
            background: #333;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        form button:hover {
            background: #555;
        }
    </style>
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
        <table>
            <tr>
                <th>Class ID</th>
                <th>Class Name</th>
                <th>Instructor ID</th>
                <th>Schedule Time</th>
                <th>Max Slots</th>
                <th>Available Slots</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['class_id'] ?></td>
                <td><?= $row['class_name'] ?></td>
                <td><?= $row['trainer_id'] ?></td>
                <td><?= $row['schedule_time'] ?></td>
                <td><?= $row['max_slots'] ?></td>
                <td><?= $row['available_slots'] ?></td>
                <td>
                    <a href="edit_class.php?class_id=<?= $row['class_id'] ?>">Edit</a> | 
                    <a href="manage_classes.php?delete_id=<?= $row['class_id'] ?>" onclick="return confirm('Are you sure you want to delete the class?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>

        <h2>Add New Class</h2>
        <form action="manage_classes.php" method="post">
            <label for="class_name">Class Name:</label>
            <input type="text" id="class_name" name="class_name" required>
            
            <label for="instructor_id">Instructor ID:</label>
            <select name="instructor_id" id="instructor_id" required>
                <?php
                $trainer_sql = "SELECT trainer_id FROM Trainers"; 
                $trainer_result = $conn->query($trainer_sql);

                if (!$trainer_result) {
                    die("Error fetching trainers: " . $conn->error);
                }

                while ($trainer = $trainer_result->fetch_assoc()): ?>
                    <option value="<?= $trainer['trainer_id'] ?>"><?= $trainer['trainer_id'] ?></option>
                <?php endwhile; ?>
            </select>
            
            <label for="schedule_time">Schedule Time:</label>
            <input type="datetime-local" id="schedule_time" name="schedule_time" required>
            
            <label for="max_slots">Max Slots:</label>
            <input type="number" id="max_slots" name="max_slots" required>
            
            <label for="available_slots">Available Slots:</label>
            <input type="number" id="available_slots" name="available_slots" required>
            
            <button type="submit">Add Class</button>
        </form>
    </main>
</body>
</html>
<?php $conn->close(); ?>