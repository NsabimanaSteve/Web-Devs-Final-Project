<?php
include('../db_connect.php');

if (!isset($conn)) {
    die("Database connection failed.");
}

// Fetch the class details for editing
if (isset($_GET['class_id'])) {
    $class_id = $_GET['class_id'];
    $sql = "SELECT class_id, class_name, trainer_id, schedule_time, max_slots, available_slots
            FROM Classes 
            WHERE class_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $class_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($class_id, $class_name, $trainer_id, $schedule_time, $max_slots, $available_slots);
    $stmt->fetch();
    $stmt->close();
} else {
    die("Invalid class ID.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Update the class in the database
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
        header('Location: manage_classes.php');
        exit();
    } else {
        echo "<p>Error editing class: " . $stmt->error . "</p>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Class</title>
</head>
<body>
    <header>
        <h1>Edit Class</h1>
    </header>
    <main>
        <form action="edit_class.php?class_id=<?= $class_id ?>" method="post">
            <label for="class_name">Class Name:</label>
            <input type="text" id="class_name" name="class_name" value="<?= $class_name ?>" required>
            
            <label for="instructor_id">Instructor ID:</label>
            <input type="text" id="instructor_id" name="instructor_id" value="<?= $trainer_id ?>" required>
            
            <label for="schedule_time">Schedule Time:</label>
            <input type="datetime-local" id="schedule_time" name="schedule_time" value="<?= $schedule_time ?>" required>
            
            <label for="max_slots">Max Slots:</label>
            <input type="number" id="max_slots" name="max_slots" value="<?= $max_slots ?>" required>
            
            <label for="available_slots">Available Slots:</label>
            <input type="number" id="available_slots" name="available_slots" value="<?= $available_slots ?>" required>
            
            <button type="submit" name="edit">Save Changes</button>
        </form>
    </main>
</body>
</html>
<?php $conn->close(); ?>
