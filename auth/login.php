<?php
session_start();
require '../db_connect.php';

$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $error_message = "Please fill in all fields";
    } else {
        $stmt = $conn->prepare("SELECT user_id, full_name, role_id, email, password FROM Users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            $error_message = "Invalid email or password";
        } else {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Additional email pattern verification
                $expected_role_id = 1; // Default to member
                if (stripos($email, 'FIHadmin') !== false) {
                    $expected_role_id = 3;
                } elseif (stripos($email, 'FIHtrainer') !== false) {
                    $expected_role_id = 2;
                }

                // Verify that the role_id matches the email pattern
                if ($user['role_id'] !== $expected_role_id) {
                    $error_message = "Invalid account type for this email";
                } else {
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['full_name'] = $user['full_name'];
                    $_SESSION['role_id'] = $user['role_id'];

                    // Redirect based on role_id
                    switch ($user['role_id']) {
                        case 3: // Admin
                            header("Location: ../admin/admin_index.php");
                            break;
                        case 2: // Trainer
                            header("Location: ../trainer/trainer_index.php");
                            break;
                        case 1: // Member
                            header("Location: ../user/user_index.php");
                            break;
                        default:
                            header("Location: ../index.php");
                    }
                    exit();
                }
            } else {
                $error_message = "Invalid email or password";
            }
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | FitInspire Hub</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Lato', sans-serif;
            background: linear-gradient(135deg, #1a1a1a 0%, #333333 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar Styles */
        .navbar {
            background-color: #f8f9fa;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
        }

        .navbar a {
            text-decoration: none;
            color: #343a40;
            font-weight: bold;
            margin: 0 1rem;
            font-size: 1rem;
        }

        .navbar a:hover {
            color: #BC1E4A;
        }

        .navbar .btn {
            background-color: #BC1E4A;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .navbar .btn:hover {
            background-color: #8A1435;
        }

        .login-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            backdrop-filter: blur(10px);
        }

        h1 {
            color: #BC1E4A;
            text-align: center;
            margin-bottom: 2rem;
            font-size: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            border-color: #BC1E4A;
            outline: none;
            box-shadow: 0 0 0 3px rgba(188, 30, 74, 0.1);
        }

        .login-btn {
            width: 100%;
            padding: 1rem;
            background: #BC1E4A;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-btn:hover {
            background: #8A1435;
        }

        .error-message {
            background: #fee;
            color: #c00;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            text-align: center;
        }

        .signup-link {
            text-align: center;
            margin-top: 1.5rem;
            color: #666;
        }

        .signup-link a {
            color: #BC1E4A;
            text-decoration: none;
            font-weight: 600;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .form-container {
                margin: 1rem;
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <a href="Hero.php">Home</a>
        <a href="../about.php">About</a>
        <a href="../services.php">Services</a>
        <a href="../contact.php">Contact</a>
        <a href="login.php" class="btn">Login</a>
    </div>

    <!-- Login Form -->
    <div class="login-container">
        <div class="form-container">
            <h1><i class="fas fa-dumbbell"></i> FitInspire Login</h1>
            <?php if ($error_message): ?>
                <div class="error-message">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="login.php">
                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="form-group">
                    <label for="password"><i class="fas fa-lock"></i> Password</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <button type="submit" class="login-btn">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>
            <div class="signup-link">
                Don't have an account? <a href="signup.php">Sign up here</a>
            </div>
        </div>
    </div>
</body>
</html>
