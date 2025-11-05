<?php
session_start();
require_once "../src/config/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$today_sql = "SELECT SUM(amount) AS total FROM expenses WHERE user_id = ? AND DATE(expense_date) = CURDATE()";
$stmt = $conn->prepare($today_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$today_total = $stmt->get_result()->fetch_assoc()['total'] ?? 0;


$yesterday_sql = "SELECT SUM(amount) AS total FROM expenses WHERE user_id = ? AND DATE(expense_date) = CURDATE() - INTERVAL 1 DAY";
$stmt = $conn->prepare($yesterday_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$yesterday_total = $stmt->get_result()->fetch_assoc()['total'] ?? 0;


$week_sql = "SELECT SUM(amount) AS total FROM expenses WHERE user_id = ? AND YEARWEEK(expense_date, 1) = YEARWEEK(CURDATE(), 1)";
$stmt = $conn->prepare($week_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$week_total = $stmt->get_result()->fetch_assoc()['total'] ?? 0;


$month_sql = "SELECT SUM(amount) AS total FROM expenses WHERE user_id = ? AND MONTH(expense_date) = MONTH(CURDATE()) AND YEAR(expense_date) = YEAR(CURDATE())";
$stmt = $conn->prepare($month_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$month_total = $stmt->get_result()->fetch_assoc()['total'] ?? 0;


$year_sql = "SELECT SUM(amount) AS total FROM expenses WHERE user_id = ? AND YEAR(expense_date) = YEAR(CURDATE())";
$stmt = $conn->prepare($year_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$year_total = $stmt->get_result()->fetch_assoc()['total'] ?? 0;


$total_sql = "SELECT SUM(amount) AS total FROM expenses WHERE user_id = ?";
$stmt = $conn->prepare($total_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$total_expense = $stmt->get_result()->fetch_assoc()['total'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ExpenseMate</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>
<body>

    <?php include "../includes/navbar.php"; ?>

    <div class="dashboard-container">
        <h1>Welcome to ExpenseMate, <?php echo htmlspecialchars($_SESSION['full_name']); ?> &#128075; </h1>
        <p class="subtitle">Here’s a quick summary of your expenses.</p>

        <div class="stats-grid">
            <div class="card">
                <h3>Today's Expense</h3>
                <p>₹<?php echo number_format($today_total, 2); ?></p>
            </div>

            <div class="card">
                <h3>Yesterday's Expense</h3>
                <p>₹<?php echo number_format($yesterday_total, 2); ?></p>
            </div>

            <div class="card">
                <h3>This Week</h3>
                <p>₹<?php echo number_format($week_total, 2); ?></p>
            </div>

            <div class="card">
                <h3>This Month</h3>
                <p>₹<?php echo number_format($month_total, 2); ?></p>
            </div>

            <div class="card">
                <h3>This Year</h3>
                <p>₹<?php echo number_format($year_total, 2); ?></p>
            </div>

            <div class="card total">
                <h3>Total Expense</h3>
                <p>₹<?php echo number_format($total_expense, 2); ?></p>
            </div>
        </div>
    </div>

    <?php include "../includes/footer.php"; ?>

</body>
</html>
