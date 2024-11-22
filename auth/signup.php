<?php
session_start();
require '../db_connect.php';

$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    // Basic validation
    if (empty($full_name) || empty($email) || empty($password) || empty($role)) {
        $error_message = "All fields are required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format";
    } elseif (strlen($password) < 8) {
        $error_message = "Password must be at least 8 characters long";
    } else {
        // Check if email exists
        $check_email = $conn->prepare("SELECT email FROM Users WHERE email = ?");
        $check_email->bind_param("s", $email);
        $check_email->execute();
        if ($check_email->get_result()->num_rows > 0) {
            $error_message = "Email already exists";
        } else {
            // Determine role based on email pattern
            if (stripos($email, 'FIHadmin') !== false) {
                if ($role !== 'admin') {
                    $error_message = "Invalid role selection for this email type";
                }
                $role_id = 3; // Admin
            } elseif (stripos($email, 'FIHtrainer') !== false) {
                if ($role !== 'trainer') {
                    $error_message = "Invalid role selection for this email type";
                }
                $role_id = 2; // Trainer
            } else {
                if ($role !== 'member') {
                    $error_message = "This email is only valid for member accounts";
                }
                $role_id = 1; // Member
            }

            if (empty($error_message)) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                
                $stmt = $conn->prepare("INSERT INTO Users (role_id, full_name, email, password) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("isss", $role_id, $full_name, $email, $hashed_password);

                if ($stmt->execute()) {
                    $success_message = "Registration successful! Please <a href='login.php'>login</a>";
                } else {
                    $error_message = "Registration failed. Please try again.";
                }
                $stmt->close();
            }
        }
        $check_email->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | FitInspire Hub</title>
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

        .signup-container {
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
            max-width: 500px;
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

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #BC1E4A;
            outline: none;
            box-shadow: 0 0 0 3px rgba(188, 30, 74, 0.1);
        }

        .signup-btn {
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

        .signup-btn:hover {
            background: #8A1435;
        }

        .message {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            text-align: center;
        }

        .error-message {
            background: #fee;
            color: #c00;
        }

        .success-message {
            background: #efe;
            color: #070;
        }

        .success-message a {
            color: #BC1E4A;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            color: #666;
        }

        .login-link a {
            color: #BC1E4A;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
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
    <div class="signup-container">
        <div class="form-container">
            <h1><i class="fas fa-dumbbell"></i> Join FitInspire Hub</h1>
            
            <?php if ($error_message): ?>
                <div class="message error-message">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <?php if ($success_message): ?>
                <div class="message success-message">
                    <?php echo $success_message; ?>
                </div>
            <?php endif; ?>

            <?php if (!$success_message): ?>
                <form method="POST" action="signup.php">
                    <div class="form-group">
                        <label for="full_name"><i class="fas fa-user"></i> Full Name</label>
                        <input type="text" name="full_name" id="full_name" required>
                    </div>

                    <div class="form-group">
                        <label for="email"><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" name="email" id="email" required>
                    </div>

                    <div class="form-group">
                        <label for="password"><i class="fas fa-lock"></i> Password</label>
                        <input type="password" name="password" id="password" required>
                    </div>

                    <div class="form-group">
                        <label for="role"><i class="fas fa-users"></i> Role</label>
                        <select name="role" id="role" required>
                            <option value="" disabled selected>Sign up as:</option>
                            <option value="member">Member</option>
                            <option value="trainer">Trainer</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <button type="submit" class="signup-btn">
                        <i class="fas fa-user-plus"></i> Sign Up
                    </button>
                </form>
            <?php endif; ?>

            <div class="login-link">
                Already have an account? <a href="login.php">Login here</a>
            </div>
        </div>
    </div>
</body>
</html>