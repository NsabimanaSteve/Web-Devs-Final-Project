<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
           /* General Body Styling */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        /* Profile Section */
        .profile-container {
            display: flex;
            align-items: center;
            background-color: #111827;
            color: #ffffff;
            padding: 15px 20px;
            border-radius: 8px;
            width: 300px;
        }

        .profile-icon {
            font-size: 40px;
            margin-right: 15px;
            color: #2563eb; /* Blue highlight for icon */
        }

        .profile-details {
            display: flex;
            flex-direction: column;
        }

        .profile-details h2 {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
            color: #ffffff;
        }

        .profile-details p {
            margin: 5px 0 0;
            font-size: 14px;
            color: #9ca3af; /* Subdued text color for role */
        }
        /* General Styles */
        body {
            font-family: 'Lato', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        /* Dashboard Container */
        .dashboard-container {
            display: flex;
            height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            background-color: #111827;
            color: #ffffff;
            width: 250px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
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
            border: 2px solid #2563eb;
        }

        .user-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .role {
            font-size: 14px;
            color: #9ca3af;
        }

        .sidebar-nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-nav li {
            margin-bottom: 20px;
        }

        .sidebar-nav a {
            text-decoration: none;
            color: #e5e7eb;
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
        }

        .sidebar-nav a:hover {
            background-color: #2563eb;
            color: #ffffff;
        }

        .icon {
            margin-right: 15px;
            font-size: 18px;
        }

        /* Footer Section */
        .sidebar-footer {
            text-align: center;
            font-size: 12px;
            color: #9ca3af;
        }

        /* Main Content */
        .dashboard-main {
            flex: 1;
            background-color: #ffffff;
            padding: 40px;
        }

        .dashboard-content {
            background-color: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .dashboard-content h1 {
            font-size: 24px;
            font-weight: bold;
            color: #111827;
        }

        .dashboard-content p {
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div>
                <!-- Profile Section -->
                <div class="profile-container">
        			<i class="fas fa-user-circle profile-icon"></i>
        			<div class="profile-details">
            			<h2>Admin Panel</h2>
            			<p>System Administrator</p>
       				 </div>
   				 </div>
                 
                <!-- Sidebar Navigation -->
                <nav class="sidebar-nav">
                    <ul>
                        <li><a href="manage_members.php"><i class="fas fa-users icon"></i> Member Management</a></li>
                        <li><a href="manage_classes.php"><i class="fas fa-calendar-alt icon"></i> Class Scheduling</a></li>
                        <li><a href="reports_for_admin.php"><i class="fas fa-chart-bar icon"></i>Analytics Dashboard</a></li>
                        <li><a href="../auth/logout.php"><i class="fas fa-sign-out-alt icon"></i> Logout </a></li>

                    </ul>
                </nav>
            </div>

            <!-- Footer -->
            <div class="sidebar-footer">
                &copy; 2024 Gym Management System
            </div>
        </div>

        <!-- Main Content -->
        <div class="dashboard-main">
            <div class="dashboard-content">
                <h1>Welcome to the Admin Dashboard</h1>
                <p>Select an option from the sidebar to begin managing the system.</p>
            </div>
        </div>
    </div>
</body>
</html>
