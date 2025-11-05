<?php
require_once __DIR__ . '/../src/config/db.php';
require_once __DIR__ . '/../src/helpers/sanitize.php';
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: ../pages/dashboard.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitize_input($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $error = 'Both email and password are required.';
    } else {
        $stmt = run_prepared_query("SELECT id, full_name, password_hash FROM users WHERE email = ?", 's', [$email]);
        if ($stmt) {
            $result = $stmt->get_result();
            if ($result && $result->num_rows === 1) {
                $user = $result->fetch_assoc();

                if (password_verify($password, $user['password_hash'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['full_name'] = $user['full_name'];
                    $_SESSION['email'] = $email;
                    header("Location: ../pages/dashboard.php");
                    exit;
                } else {
                    $error = 'Incorrect password.';
                }
            } else {
                $error = 'No account found with that email.';
            }
            $stmt->close();
        } else {
            $error = 'Database query failed. Try again later.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ExpenseMate</title>
    <style>
        /* ===== GLOBAL ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            background: radial-gradient(circle at top left, #1f1f1f, #0d0d0d 70%);
            color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        /* ==== BACKGROUND EFFECT ==== */
        body::before {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.08), transparent 70%);
            top: -100px;
            left: -100px;
            filter: blur(120px);
            z-index: 0;
            animation: float 10s ease-in-out infinite alternate;
        }

        body::after {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.06), transparent 70%);
            bottom: -150px;
            right: -150px;
            filter: blur(120px);
            z-index: 0;
            animation: float 12s ease-in-out infinite alternate-reverse;
        }

        @keyframes float {
            0% {
                transform: translateY(0px) translateX(0px);
            }

            100% {
                transform: translateY(30px) translateX(40px);
            }
        }

        /* ===== CONTAINER ===== */
        .auth-container {
            background: rgba(20, 20, 20, 0.9);
            border-radius: 16px;
            padding: 45px 40px;
            box-shadow: 0 0 40px rgba(255, 255, 255, 0.06);
            width: 100%;
            max-width: 400px;
            text-align: center;
            border: 1px solid #222;
            position: relative;
            z-index: 1;
        }

        h2 {
            font-size: 1.8em;
            color: #fff;
            margin-bottom: 10px;
        }

        .auth-container p {
            font-size: 14px;
            color: #bbb;
            margin-bottom: 25px;
        }

        /* ===== FORM ===== */
        .auth-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            text-align: left;
            font-size: 14px;
            font-weight: 600;
            color: #ccc;
        }

        input {
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #333;
            background: #262626;
            color: #fff;
            outline: none;
            font-size: 15px;
            transition: 0.2s;
        }

        input:focus {
            border-color: #555;
            background: #2e2e2e;
        }

        /* ===== BUTTON ===== */
        .btn-primary {
            background: #fff;
            color: #000;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background: #ddd;
        }

        /* ===== ALERT ===== */
        .alert {
            margin-bottom: 15px;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            text-align: center;
        }

        .alert.error {
            background: #c62828;
            color: #fff;
        }

        /* ===== SWITCH AUTH ===== */
        .switch-auth {
            margin-top: 10px;
            font-size: 14px;
            color: #ccc;
        }

        .switch-auth a {
            color: #fff;
            text-decoration: underline;
            font-weight: 600;
        }

        .switch-auth a:hover {
            opacity: 0.8;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 600px) {
            .auth-container {
                margin: 15px;
                padding: 35px 25px;
            }
        }
    </style>
</head>

<body>
    <div class="auth-container">
        <h2>Welcome Back!</h2>
        <p>Login to track your expenses easily with <strong>ExpenseMate</strong>.</p>

        <?php if ($error): ?>
            <div class="alert error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form action="" method="POST" class="auth-form">
            <label>Email</label>
            <input type="email" name="email" placeholder="Enter your email" required>

            <label>Password</label>
            <input type="password" name="password" placeholder="Enter your password" required>

            <button type="submit" class="btn-primary">Login</button>

            <p class="switch-auth">Don’t have an account? <a href="signup.php">Sign up</a></p>
        </form>
    </div>
</body>

</html>