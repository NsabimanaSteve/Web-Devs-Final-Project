<?php
session_start();
if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 1) {
    header("Location: ../auth/login.php");
    exit;
}

include '../includes/db_connect.php';

// Member count
$member_count_sql = "SELECT COUNT(*) AS total_members FROM Members";
$member_count_result = $conn->query($member_count_sql);
$member_count = $member_count_result->fetch_assoc()['total_members'];

// Class count
$class_count_sql = "SELECT COUNT(*) AS total_classes FROM Classes";
$class_count_result = $conn->query($class_count_sql);
$class_count = $class_count_result->fetch_assoc()['total_classes'];

// Attendance stats
$attendance_sql = "SELECT COUNT(*) AS total_attendance FROM ClassAttendance";
$attendance_result = $conn->query($attendance_sql);
$total_attendance = $attendance_result->fetch_assoc()['total_attendance'];

// Payments stats
$payments_sql = "SELECT SUM(amount) AS total_revenue FROM Payments";
$payments_result = $conn->query($payments_sql);
$total_revenue = $payments_result->fetch_assoc()['total_revenue'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
</head>
<body>
    <header>
        <h1>Gym Reports</h1>
        <nav>
            <ul>
                <li><a href="index.php">Dashboard</a></li>
                <li><a href="../auth/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Summary</h2>
        <table border="1">
            <tr>
                <th>Metric</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>Total Members</td>
                <td><?= $member_count ?></td>
            </tr>
            <tr>
                <td>Total Classes</td>
                <td><?= $class_count ?></td>
            </tr>
            <tr>
                <td>Total Attendance</td>
                <td><?= $total_attendance ?></td>
            </tr>
            <tr>
                <td>Total Revenue</td>
                <td>GHS <?= number_format($total_revenue, 2) ?></td>
            </tr>
        </table>

        <h2>Detailed Reports</h2>
        <p>(You can expand this section to include dynamic charts or exportable reports.)</p>
    </main>
</body>
</html>
<?php $conn->close(); ?>
