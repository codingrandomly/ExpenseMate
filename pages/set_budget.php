<?php
session_start();
require_once "../src/config/db.php";
require_once "../src/helpers/sanitize.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$message = "";

$current_year = date("Y");
$current_month = date("n"); 

$stmt = $conn->prepare("SELECT limit_amount FROM budgets WHERE user_id = ? AND year = ? AND month = ?");
$stmt->bind_param("iii", $user_id, $current_year, $current_month);
$stmt->execute();
$result = $stmt->get_result();
$current_limit = ($result->num_rows > 0) ? $result->fetch_assoc()['limit_amount'] : 0;
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $new_limit = floatval($_POST["monthly_limit"]);

    if ($new_limit > 0) {
    
        $stmt = $conn->prepare("SELECT id FROM budgets WHERE user_id = ? AND year = ? AND month = ?");
        $stmt->bind_param("iii", $user_id, $current_year, $current_month);
        $stmt->execute();
        $check = $stmt->get_result();
        $exists = $check->num_rows > 0;
        $stmt->close();

        if ($exists) {
          
            $stmt = $conn->prepare("UPDATE budgets SET limit_amount = ? WHERE user_id = ? AND year = ? AND month = ?");
            $stmt->bind_param("diii", $new_limit, $user_id, $current_year, $current_month);
        } else {
    
            $stmt = $conn->prepare("INSERT INTO budgets (user_id, year, month, limit_amount) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiid", $user_id, $current_year, $current_month, $new_limit);
        }

        if ($stmt->execute()) {
            $message = "<p class='success'>Budget updated successfully!</p>";
            $current_limit = $new_limit;
        } else {
            $message = "<p class='error'>Error updating budget. Please try again.</p>";
        }
        $stmt->close();
    } else {
        $message = "<p class='error'>Please enter a valid amount.</p>";
    }
}

$stmt = $conn->prepare("SELECT SUM(amount) AS total FROM expenses WHERE user_id = ? AND YEAR(expense_date) = ? AND MONTH(expense_date) = ?");
$stmt->bind_param("iii", $user_id, $current_year, $current_month);
$stmt->execute();
$result = $stmt->get_result();
$current_expense = $result->fetch_assoc()['total'] ?? 0;
$stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Budget | ExpenseMate</title>
    <link rel="stylesheet" href="../assets/css/main.css">
</head>
<body>
    <?php include "../includes/navbar.php"; ?>

    <div class="container">
        <h2>Set Monthly Budget</h2>
        <?= $message; ?>

        <form method="POST" class="form-card">
            <div class="form-group">
                <label for="monthly_limit">Monthly Budget Limit (₹)</label>
                <input type="number" name="monthly_limit" id="monthly_limit" step="0.01" min="0" value="<?= htmlspecialchars($current_limit) ?>" required>
            </div>
            <button type="submit" class="btn">Save Budget</button>
        </form>

        <div class="budget-status">
            <h3>Current Month Summary (<?= date("F Y") ?>)</h3>
            <p><strong>Budget Limit:</strong> ₹<?= number_format($current_limit, 2); ?></p>
            <p><strong>Expenses:</strong> ₹<?= number_format($current_expense, 2); ?></p>
            <p><strong>Remaining:</strong> ₹<?= number_format(($current_limit - $current_expense), 2); ?></p>
        </div>
    </div>

    <?php include "../includes/footer.php"; ?>
</body>
</html>
