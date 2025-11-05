<?php

session_start();
require_once __DIR__ . '/../src/config/db.php';
require_once __DIR__ . '/../src/helpers/sanitize.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$message = "";
$showBudgetAlert = false; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $category = sanitize_input($_POST["category"]);
    $item = sanitize_input($_POST["item"]);
    $price = floatval($_POST["price"]);
    $details = sanitize_input($_POST["details"]);
    $expense_date = sanitize_input($_POST["expense_date"]);
    $user_id = $_SESSION["user_id"];

    if (!empty($category) && !empty($item) && !empty($price) && !empty($expense_date)) {
   
        $stmt = $conn->prepare("INSERT INTO expenses (user_id, category, item, amount, details, expense_date) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issdss", $user_id, $category, $item, $price, $details, $expense_date);

        if ($stmt->execute()) {
        
            $current_year = date("Y");
            $current_month = date("n");

            $stmt_budget = $conn->prepare("SELECT limit_amount FROM budgets WHERE user_id = ? AND year = ? AND month = ?");
            $stmt_budget->bind_param("iii", $user_id, $current_year, $current_month);
            $stmt_budget->execute();
            $result_budget = $stmt_budget->get_result();
            $budget = ($result_budget->num_rows > 0) ? $result_budget->fetch_assoc()['limit_amount'] : 0;
            $stmt_budget->close();

            $stmt_exp = $conn->prepare("SELECT SUM(amount) AS total FROM expenses WHERE user_id = ? AND YEAR(expense_date) = ? AND MONTH(expense_date) = ?");
            $stmt_exp->bind_param("iii", $user_id, $current_year, $current_month);
            $stmt_exp->execute();
            $result_exp = $stmt_exp->get_result();
            $total_expense = $result_exp->fetch_assoc()['total'] ?? 0;
            $stmt_exp->close();

            if ($budget > 0 && $total_expense > $budget) {
                $showBudgetAlert = true;
                $exceeded = $total_expense - $budget;
                $message = "<div class='alert error'>&#9888; Budget Exceeded! You’ve spent ₹" . number_format($exceeded, 2) . " over your ₹" . number_format($budget, 2) . " limit.</div>";
            } else {
                $message = "<div class='alert success'> Expense added successfully!</div>";
            }
        } else {
            $message = "<div class='alert error'> Error: Could not add expense. Please try again.</div>";
        }

        $stmt->close();
    } else {
        $message = "<div class='alert error'>&#9888; Please fill all required fields.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Expense | ExpenseMate</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <style>
        

        .container {
            width: 100%;
            max-width: 600px;
            background: #1a1a1a;
            padding: 35px 30px;
            border-radius: 16px;
            box-shadow: 0 0 25px rgba(255, 255, 255, 0.08);
            text-align: left;
        }

        h2 {
            text-align: center;
            color: #fff;
            margin-bottom: 25px;
            font-size: 1.8em;
        }

        form.form-card {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: 600;
            margin-bottom: 6px;
            color: #ccc;
        }

        input, select, textarea {
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #333;
            background: #262626;
            color: #fff;
            font-size: 15px;
            outline: none;
            transition: all 0.2s ease;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #888;
            background: #2e2e2e;
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }

        .btn {
            background: linear-gradient(90deg, #00bcd4, #4caf50);
            color: #fff;
            font-weight: 600;
            border: none;
            padding: 12px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 188, 212, 0.4);
        }

        .alert {
            text-align: center;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 12px;
            font-weight: 600;
        }

        .alert.success { background-color: #2e7d32; color: #fff; }
        .alert.error { background-color: #c62828; color: #fff; }

        @media (max-width: 768px) {
            .container {
                margin: 20px;
                padding: 25px;
            }
        }
    </style>
</head>
<body>
    <?php include "../includes/navbar.php"; ?>

    <div class="container">
        <h2>Add New Expense</h2>
        <?= $message; ?>
        <form method="POST" class="form-card">
            <div class="form-group">
                <label for="category">Category *</label>
                <select id="category" name="category" required>
                    <option value="">Select Category</option>
                    <option value="Food">Food</option>
                    <option value="Transport">Transport</option>
                    <option value="Shopping">Shopping</option>
                    <option value="Bills">Bills</option>
                    <option value="Entertainment">Entertainment</option>
                    <option value="Healthcare">Healthcare</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="item">Item *</label>
                <input type="text" id="item" name="item" placeholder="e.g., Coffee, Bus Ticket" required>
            </div>

            <div class="form-group">
                <label for="price">Amount (₹)*</label>
                <input type="number" id="price" name="price" step="0.01" min="0" placeholder="Enter amount" required>
            </div>

            <div class="form-group">
                <label for="details">Details</label>
                <textarea id="details" name="details" placeholder="Optional details..."></textarea>
            </div>

            <div class="form-group">
                <label for="expense_date">Expense Date *</label>
                <input type="date" id="expense_date" name="expense_date" required>
            </div>

            <button type="submit" class="btn">+ Add Expense</button>
        </form>
    </div>

    <?php include "../includes/footer.php"; ?>

    <?php if ($showBudgetAlert): ?>
    <script>
        alert(`\u26A0\uFE0F Warning: You have exceeded your monthly budget limit!`);
    </script>
    <?php endif; ?>
</body>
</html>
