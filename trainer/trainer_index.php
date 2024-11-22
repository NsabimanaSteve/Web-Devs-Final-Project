<?php
session_start();
if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 2) {
    header("Location: ../auth/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainer Dashboard</title>
</head>
<body>
    <header>
        <h1>Welcome to the Trainer Dashboard</h1>
        <nav>
            <ul>
                <li><a href="schedule.php">View Schedule</a></li>
                <li><a href="attendance.php">Manage Attendance</a></li>
                <li><a href="feedback.php">View Feedback</a></li>
                <li><a href="../auth/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <p>Welcome to the Trainer Dashboard! Here you can manage your classes, attendance, and feedback.</p>

        <form id="addAvailabilityForm">
    <input type="hidden" name="trainer_id" value="1"> <!-- Replace with dynamic trainer ID -->
    <label for="available_date">Available Date:</label>
    <input type="date" name="available_date" required>
    <label for="available_time">Available Time:</label>
    <input type="time" name="available_time" required>
    <button type="submit">Add Availability</button>
</form>

<script>
document.getElementById('addAvailabilityForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);

    const response = await fetch('add_availability.php', {
        method: 'POST',
        body: formData,
    });

    const result = await response.json();
    alert(result.message || result.error);
});
</script>

    </main>
</body>
</html>
