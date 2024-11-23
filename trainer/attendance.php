<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
        }
        header {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
        }
        header .nav-buttons a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
            padding: 5px 10px;
            background: #444;
            border-radius: 4px;
        }
        header .nav-buttons a:hover {
            background: #555;
        }
        .sidebar {
            position: fixed;
            left: 0;
            top: 50px;
            width: 250px;
            height: 100%;
            background-color: #222;
            padding: 20px 0;
            overflow-y: auto;
            z-index: 500;
        }
        .sidebar a {
            color: #ddd;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
            border-bottom: 1px solid #333;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #444;
            color: #fff;
        }
        .content {
            margin-left: 250px;
            margin-top: 60px;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #f4f4f4;
        }
        .btn {
            padding: 8px 12px;
            background: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <div>
            <h1>FitInspire Gub</h1>
        </div>
        <div class="nav-buttons">
            <a href="../auth/HERO.php">Home</a>
            <a href="../auth/classes.php">Classes</a>
        </div>
    </header>
    <div class="sidebar">
        <a href="trainer_index.php">Dashboard</a>
        <a href="attendance.php" class="active">Attendance</a>
        <a href="schedule.php">Schedules</a>
        <a href="trainer_feedback.php">Feedback</a>
        <a href=trainer_profile.php>My Profile</a>
    </div>
    <div class="content">
        <h2>Attendance</h2>
        <table>
            <tr>
                <th>Member Name</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
            <tr>
                <td>John Doe</td>
                <td>2024-11-23</td>
                <td><button class="btn">Mark Present</button></td>
            </tr>
            <tr>
                <td>Jane Smith</td>
                <td>2024-11-23</td>
                <td><button class="btn">Mark Present</button></td>
            </tr>
        </table>
    </div>
</body>
</html>
