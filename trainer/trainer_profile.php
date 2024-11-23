<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainer Profile</title>
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
        .content h2 {
            margin-bottom: 20px;
        }
        .profile-card {
            background: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 600px;
            margin: auto;
            text-align: center;
        }
        .profile-card img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 4px solid #ddd;
            margin-bottom: 15px;
        }
        .profile-card h3 {
            margin: 10px 0;
            font-size: 22px;
            color: #333;
        }
        .profile-card p {
            margin: 5px 0;
            color: #555;
        }
        .profile-card .btn-edit {
            margin-top: 20px;
            padding: 10px 20px;
            background: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .profile-card .btn-edit:hover {
            background: #0056b3;
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
            <a href="../auth/HeroClasses.php">Classes</a>
        </div>
    </header>
    <div class="sidebar">
        <a href="trainer_index.php">Dashboard</a>
        <a href="attendance.php">Attendance</a>
        <a href="schedule.php">Schedules</a>
        <a href="trainer_feedback.php">Feedback</a>
        <a href="trainer_profile.php" class="active">My Profile</a>
    </div>
    <div class="content">
        <h2>Trainer Profile</h2>
        <div class="profile-card">
            <img src="trainer-placeholder.jpg" alt="Trainer Profile Picture">
            <h3>John Doe</h3>
            <p><strong>Email:</strong> johndoe@example.com</p>
            <p><strong>Phone:</strong> +123-456-7890</p>
            <p><strong>Specialization:</strong> Strength Training, Yoga</p>
            <p><strong>Joined:</strong> January 2021</p>
            <button class="btn-edit">Edit Profile</button>
        </div>
    </div>
</body>
</html>
