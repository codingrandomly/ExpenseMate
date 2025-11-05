<?php

session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: pages/dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExpenseMate - Smart Expense Management</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

    <?php include 'includes/navbar.php'; ?>

    <section class="hero">
        <div class="hero-content">
            <h1>Take Control of Your Finances</h1>
            <p>ExpenseMate helps you track, manage, and visualize your spending — all in one place.</p>
            <div class="hero-buttons">
                <a href="auth/login.php" class="btn">Login</a>
                <a href="auth/signup.php" class="btn btn-secondary">Sign Up</a>
            </div>
        </div>
    </section>

    <section class="features">
        <h2 class="text-center">Why Choose ExpenseMate?</h2>
        <div class="features-grid">
            <div class="feature-card">
                <h3>&#128202; Easy Expense Tracking</h3>
                <p>Log your daily expenses quickly and view detailed summaries anytime.</p>
            </div>
            <div class="feature-card">
                <h3>&#128197; Smart Reports</h3>
                <p>Visualize your spending patterns with category-wise and date-wise reports.</p>
            </div>
            <div class="feature-card">
                <h3>&#128176; Budget Alerts</h3>
                <p>Set monthly spending limits and get instant email warnings if you exceed them.</p>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

    <script src="assets/js/main.js"></script>

    <style>
       
        .hero {
            background: linear-gradient(to bottom right, #1e1e1e, #121212);
            color: #fff;
            padding: 6rem 2rem;
            text-align: center;
        }

        .hero-content h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .hero-content p {
            color: #ccc;
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto 2rem;
        }

        .hero-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        .features {
            background-color: #1a1a1a;
            padding: 4rem 2rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .feature-card {
            background-color: #222;
            border: 1px solid #333;
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            border-color: #4CAF50;
        }

        .feature-card h3 {
            color: #4CAF50;
            margin-bottom: 1rem;
        }

        .feature-card p {
            color: #bbb;
            font-size: 0.95rem;
        }

        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2rem;
            }
            .hero-buttons {
                flex-direction: column;
            }
        }
    </style>

</body>
</html>
