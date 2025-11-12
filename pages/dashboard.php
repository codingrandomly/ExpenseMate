<?php
/**
 * Dashboard Page - UNIT-I: Variables, Arrays, Loops, Control Statements
 */
$pageTitle = "Dashboard";
include '../includes/config.php';
include '../includes/header.php';

// UNIT-I: Calculate totals using foreach and control statements
$totalExpense = 0;
$expenses = $tracker->getExpenses();
$today = date('Y-m-d');
$thisMonth = date('Y-m');
$monthTotal = 0;
$todayTotal = 0;

// UNIT-I: foreach loop
foreach ($expenses as $expense) {
    $totalExpense += $expense->getAmount();
    if (strpos($expense->getDate(), $thisMonth) === 0) {
        $monthTotal += $expense->getAmount();
    }
    if ($expense->getDate() === $today) {
        $todayTotal += $expense->getAmount();
    }
}
?>

<h2 class="text-white mb-4"><i class="fas fa-chart-pie"></i> Dashboard</h2>

<!-- Statistics Row -->
<div class="row">
    <div class="col-md-3 col-sm-6">
        <div class="stat-box">
            <h6>Today's Expenses</h6>
            <h3>₹<?php echo number_format($todayTotal, 2); ?></h3>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="stat-box">
            <h6>This Month</h6>
            <h3>₹<?php echo number_format($monthTotal, 2); ?></h3>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="stat-box">
            <h6>Total Expenses</h6>
            <h3>₹<?php echo number_format($totalExpense, 2); ?></h3>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="stat-box">
            <h6>Total Entries</h6>
            <h3><?php echo count($expenses); ?></h3>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row mt-5">
    <div class="col-md-6">
        <div class="card-custom">
            <div class="card-body p-4">
                <h5 class="card-title mb-4"><i class="fas fa-doughnut"></i> Spending by Category</h5>
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card-custom">
            <div class="card-body p-4">
                <h5 class="card-title mb-4"><i class="fas fa-list"></i> Recent Expenses</h5>
                <div class="recent-expenses">
                    <?php
                    $recentExpenses = array_slice($expenses, -5);
                    if (empty($recentExpenses)) {
                        echo '<p class="text-muted">No expenses yet. <a href="add_expense.php">Add one now!</a></p>';
                    } else {
                        foreach (array_reverse($recentExpenses) as $expense) {
                            $catData = $categories[$expense->getCategory()];
                            echo '<div style="border-left: 4px solid ' . htmlspecialchars($catData['color']) . '; padding: 10px; margin-bottom: 10px;">';
                            echo '<strong>' . htmlspecialchars($expense->getDescription()) . '</strong><br>';
                            echo '<small class="text-muted">' . htmlspecialchars($expense->getDate()) . ' · ' . htmlspecialchars($catData['name']) . '</small><br>';
                            echo '<strong style="color: ' . htmlspecialchars($catData['color']) . ';">₹' . number_format($expense->getAmount(), 2) . '</strong>';
                            echo '</div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener('load', function() {
        const categoryData = <?php echo json_encode($tracker->getTotalByCategory()); ?>;
        const categories = <?php echo json_encode($categories); ?>;
        
        const labels = Object.keys(categoryData).map(cat => categories[cat].name);
        const colors = Object.keys(categoryData).map(cat => categories[cat].color);
        const data = Object.values(categoryData);
        
        if (data.length > 0) {
            const ctx = document.getElementById('categoryChart');
            if (ctx) {
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: colors,
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: { legend: { position: 'bottom' } }
                    }
                });
            }
        }
    });
</script>

<?php include '../includes/footer.php'; ?>
