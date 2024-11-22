<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym User Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        /* Dashboard Container */
        .dashboard-container {
            display: flex;
            height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            background-color: pink;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 200px;
        }

        .profile-section {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-image {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 10px;
            border: 2px solid #007bff;
        }

        .user-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .membership-type {
            font-size: 14px;
            color: #6c757d;
        }

        .sidebar-nav ul {
            list-style: none;
            padding: 0;
        }

        .sidebar-nav li {
            margin-bottom: 10px;
        }

        .sidebar-nav a {
            text-decoration: none;
            color: #343a40;
            display: flex;
            align-items: center;
        }

        .sidebar-nav a:hover {
            color: #007bff;
        }

        .icon {
            margin-right: 10px;
            font-size: 18px;
        }

        .membership-status {
            background-color: #e9f7ef;
            padding: 10px;
            border-radius: 8px;
            text-align: center;
            margin-top: 20px;
        }

        .status {
            color: #28a745;
            font-weight: bold;
        }

        .expiry {
            font-size: 12px;
            color: #6c757d;
        }

        /* Main Content Styles */
        .dashboard-main {
            flex: 1;
            padding: 30px;
        }

        .dashboard-content {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
        }

        .dashboard-content h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .dashboard-content p {
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Profile Section -->
            <div class="profile-section">
                <img src="images/profile_placeholder.png" alt="User Avatar" class="profile-image">
                <h2 class="user-name">John Doe</h2>
                <p class="membership-type">Premium Member</p>
            </div>

            <!-- Sidebar Navigation -->
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="#"><i class="icon">💪</i> Workout Plans</a></li>
                    <li><a href="#"><i class="icon">📅</i> Schedule</a></li>
                    <li><a href="#"><i class="icon">📊</i> Progress Tracker</a></li>
                    <li><a href="#"><i class="icon">📈</i> Performance Metrics</a></li>
                    <li><a href="#"><i class="icon">🏆</i> Achievements</a></li>
                    <li><a href="#"><i class="icon">⚙️</i> Settings</a></li>
                </ul>
            </nav>

            <!-- Membership Status -->
            <div class="membership-status">
                <p><strong>Membership Status</strong></p>
                <p class="status">Active</p>
                <p class="expiry">Expires: Dec 2024</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="dashboard-main">
            <div class="dashboard-content">
                <h1>Welcome to Your Dashboard</h1>
                <p>Select an option from the sidebar to get started.</p>
            </div>
        </div>
    </div>
</body>
</html>