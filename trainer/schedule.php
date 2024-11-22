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
    <title>Trainer Schedule</title>
</head>
<body>
    <header>
        <h1>Your Schedule</h1>
        <nav>
            <ul>
                <li><a href="index.php">Dashboard</a></li>
                <li><a href="../auth/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <p>Here you can view your schedule for gym classes and personal training sessions.</p>
        <p>(This is a placeholder page. Add functionality to fetch and display schedule details dynamically.)</p>
    </main>
</body>
</html>
