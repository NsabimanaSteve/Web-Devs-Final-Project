<?php
session_start();
if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 3) {
    header("Location: ../auth/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <header>
        <h1>Welcome to the Admin Dashboard</h1>
        <nav>
            <ul>
                <li><a href="manage_members.php">Manage Members</a></li>
                <li><a href="manage_classes.php">Manage Classes</a></li>
                <li><a href="reports.php">View Reports</a></li>
                <li><a href="../auth/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <p>Here you can manage all the activities of the gym, including member registration, classes, and reports.</p>
    </main>
</body>
</html>
