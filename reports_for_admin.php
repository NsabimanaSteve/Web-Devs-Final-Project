<?php
include('../db_connect.php'); 

if (!$conn) {
    die("Database connection failed: " . $conn->connect_error);
}

// Total users
$total_users_sql = "SELECT COUNT(*) AS total_users FROM Users";
$total_users_result = $conn->query($total_users_sql);
$total_users = $total_users_result ? $total_users_result->fetch_assoc()['total_users'] : 0;

// Total members
$total_members_sql = "SELECT COUNT(*) AS total_members FROM Members";
$total_members_result = $conn->query($total_members_sql);
$total_members = $total_members_result ? $total_members_result->fetch_assoc()['total_members'] : 0;

// Total admins
$total_admins_sql = "SELECT COUNT(*) AS total_admins FROM Users WHERE role = 'admin'";
$total_admins_result = $conn->query($total_admins_sql);
$total_admins = $total_admins_result ? $total_admins_result->fetch_assoc()['total_admins'] : 0;

// Total trainers
$total_trainers_sql = "SELECT COUNT(*) AS total_trainers FROM Trainers";
$total_trainers_result = $conn->query($total_trainers_sql);
$total_trainers = $total_trainers_result ? $total_trainers_result->fetch_assoc()['total_trainers'] : 0;

// Total revenue
$total_revenue_sql = "SELECT SUM(amount) AS total_revenue FROM Payments";
$total_revenue_result = $conn->query($total_revenue_sql);
$total_revenue = $total_revenue_result ? $total_revenue_result->fetch_assoc()['total_revenue'] : 0.0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <style>

        
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        header {
            background-color: #007bff;
            color: white;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
        }

        header h1 {
            margin: 0;
        }

        main {
            padding: 2rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        table th, table td {
            padding: 0.8rem;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #007bff;
            color: white;
        }

        canvas {
            margin-top: 2rem;
            max-width: 100%;
        }

        footer {
            text-align: center;
            padding: 1rem;
            background-color: #007bff;
            color: white;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <header>
        <h1>Reports</h1>
        <nav>
            <a href="index.php" style="color: white;">Dashboard</a> |
            <a href="../auth/logout.php" style="color: white;">Logout</a>
        </nav>
    </header>
    <main>
        <h2>Summary</h2>
        <table>
            <tr>
                <th>Metric</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>Total Users</td>
                <td><?= $total_users ?></td>
            </tr>
            <tr>
                <td>Total Members</td>
                <td><?= $total_members ?></td>
            </tr>
            <tr>
                <td>Total Admins</td>
                <td><?= $total_admins ?></td>
            </tr>
            <tr>
                <td>Total Trainers</td>
                <td><?= $total_trainers ?></td>
            </tr>
            <tr>
                <td>Total Revenue</td>
                <td>GHS <?= number_format($total_revenue, 2) ?></td>
            </tr>
        </table>

        <h2>Graphs</h2>
     
        <canvas id="userDistributionChart" style="max-width: 300px; height: 300px; margin: 0 auto;"></canvas>
        <canvas id="revenueChart" style="max-width: 300px; height: 300px; margin: 0 auto;"></canvas>

    </main>
    <footer>
        &copy; <?= date('Y') ?> Gym Management System. All rights reserved.
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // User Distribution Chart
            const userCtx = document.getElementById('userDistributionChart').getContext('2d');
            new Chart(userCtx, {
                type: 'pie',
                data: {
                    labels: ['Members', 'Admins', 'Trainers'],
                    datasets: [{
                        data: [<?= $total_members ?>, <?= $total_admins ?>, <?= $total_trainers ?>],
                        backgroundColor: ['#007bff', '#28a745', '#ffc107'],
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: 'top' },
                        title: { display: true, text: 'User Distribution' }
                    }
                }
            });

            // Revenue Chart
            const revenueCtx = document.getElementById('revenueChart').getContext('2d');
            new Chart(revenueCtx, {
                type: 'bar',
                data: {
                    labels: ['Total Revenue'],
                    datasets: [{
                        label: 'Revenue (GHS)',
                        data: [<?= $total_revenue ?>],
                        backgroundColor: ['#007bff']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false },
                        title: { display: true, text: 'Total Revenue' }
                    },
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        });
    </script>
</body>
</html>
