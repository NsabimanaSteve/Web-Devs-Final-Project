<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainer Dashboard</title>
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
        .card {
            background: #fff;
            margin: 10px 0;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .card h3 {
            margin: 0;
        }
        .profile-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin-bottom: 15px;
        }
        .profile-details {
            list-style-type: none;
            padding: 0;
        }
        .profile-details li {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <header>
        <div>
            <h1>FitInspire Hub</h1>
        </div>
        <div class="nav-buttons">
            <a href="../auth/HERO.php">Home</a>
            <a href="../auth/classes.php">Classes</a>
        </div>
    </header>
    <div class="sidebar">
        <a href="trainer_index.php" class="active">Dashboard</a>
        <a href="attendance.php">Attendance</a>
        <a href="schedule.php">Schedules</a>
        <a href="trainer_feedback.php">Feedback</a>
        <a href="trainer_profile.php">My Profile</a>
    </div>
    <div class="content">
        <div class="card">
            <h3>Welcome, Trainer!</h3>
            <p>Feel free to manage your classes, track attendance, and interact with your clients.</p>
        </div>
        <div class="card">
            <h3>Navigate through your dashboard here:</h3>
            <ul>
                <li><a href="attendance.php">View Attendance</a></li>
                <li><a href="schedule.php">Update Schedules</a></li>
                <li><a href="trainer_feedback.php">Check Feedback</a></li>
            </ul>
        </div>
    </div>
</body>
</html>
