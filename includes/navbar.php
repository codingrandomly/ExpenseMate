<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar">
    <div class="nav-container">
      
        <div class="nav-brand">
            <a href="../pages/dashboard.php">&#128176; ExpenseMate</a>
        </div>

        <input type="checkbox" id="menu-toggle" class="menu-toggle">
        <label for="menu-toggle" class="menu-icon"><i class="fa fa-bars"></i></label>

        <ul class="nav-links">
            <li><a href="../pages/dashboard.php" class="<?= $current_page == 'dashboard.php' ? 'active' : '' ?>">Dashboard</a></li>
            <li><a href="../pages/add_expense.php" class="<?= $current_page == 'add_expense.php' ? 'active' : '' ?>">Add Expense</a></li>
            <li><a href="../pages/report.php" class="<?= $current_page == 'report.php' ? 'active' : '' ?>">Reports</a></li>
            <li><a href="../pages/set_budget.php" class="<?= $current_page == 'set_budget.php' ? 'active' : '' ?>">Budget</a></li>
            <li><a href="../auth/logout.php" class="logout-btn">Logout</a></li>
        </ul>
    </div>
</nav>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">