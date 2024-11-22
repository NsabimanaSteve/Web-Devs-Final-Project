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
    <title>Manage Bookings</title>
</head>
<body>
    <header>
        <h1>Manage Your Bookings</h1>
        <nav>
            <ul>
                <li><a href="index.php">Dashboard</a></li>
                <li><a href="../auth/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <p>Here you can view and manage your class bookings.</p>
        <p>(This is a placeholder page. Add functionality to allow users to book or cancel classes dynamically.)</p>
    </main>
</body>
</html>
