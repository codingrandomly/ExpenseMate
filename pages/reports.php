<?php
/**
 * Reports Page - UNIT-I: Arrays, Calculations
 */
$pageTitle = "Reports";
include '../includes/config.php';
include '../includes/header.php';

$expenses = $tracker->getExpenses();
$totalExpense = array_sum(array_map(fn($e) => $e->getAmount(), $expenses));
$categoryTotals = $tracker->getTotalByCategory();
?>

<h2 class="text-white mb-4"><i class="fas fa-chart-bar"></i> Reports & Analysis</h2>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card-custom">
            <div class="card-body p-4">
                <h5 class="card-title"><i class="fas fa-list-check"></i> Category Breakdown</h5>
                <div class="category-summary mt-4">
                    <?php
                    // UNIT-I: foreach loop with control statements and calculations
                    if (empty($categoryTotals)) {
                        echo '<p class="text-muted">No expenses to analyze</p>';
                    } else {
                        foreach ($categoryTotals as $cat => $total) {
                            $catData = $categories[$cat];
                            $percentage = ($totalExpense > 0) ? ($total / $totalExpense) * 100 : 0;
                            echo '<div class="mb-3">';
                            echo '<div class="d-flex justify-content-between mb-2">';
                            echo '<span><strong>' . htmlspecialchars($catData['name']) . '</strong></span>';
                            echo '<span>₹' . number_format($total, 2) . ' (' . round($percentage) . '%)</span>';
                            echo '</div>';
                            echo '<div class="progress" style="height: 10px;">';
                            echo '<div class="progress-bar" role="progressbar" style="width: ' . $percentage . '%; background-color: ' . htmlspecialchars($catData['color']) . ';"></div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card-custom">
            <div class="card-body p-4">
                <h5 class="card-title"><i class="fas fa-download"></i> Data Management</h5>
                <div class="mt-4">
                    <button class="btn btn-custom btn-success w-100 mb-2" onclick="downloadCSV()">
                        <i class="fas fa-download"></i> Download as CSV
                    </button>
                    <button class="btn btn-custom btn-warning w-100" onclick="clearAllData()">
                        <i class="fas fa-trash"></i> Clear All Data
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card-custom">
            <div class="card-body p-4">
                <h5 class="card-title"><i class="fas fa-pie-chart"></i> Category Distribution</h5>
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card-custom">
            <div class="card-body p-4">
                <h5 class="card-title"><i class="fas fa-info-circle"></i> Summary</h5>
                <div class="mt-3">
                    <p><strong>Total Expenses:</strong> ₹<?php echo number_format($totalExpense, 2); ?></p>
                    <p><strong>Total Entries:</strong> <?php echo count($expenses); ?></p>
                    <p><strong>Categories Used:</strong> <?php echo count($categoryTotals); ?></p>
                    <?php if (count($expenses) > 0): ?>
                        <p><strong>Average Expense:</strong> ₹<?php echo number_format($totalExpense / count($expenses), 2); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // UNIT-III: File I/O - Download as CSV
    function downloadCSV() {
        const expenses = <?php echo json_encode(array_map(fn($e) => $e->toArray(), $expenses)); ?>;
        const categories = <?php echo json_encode($categories); ?>;
        
        let csv = 'Date,Category,Description,Amount,Notes\n';
        expenses.forEach(exp => {
            csv += `"${exp.date}","${categories[exp.category].name}","${exp.description}","${exp.amount}","${exp.notes}"\n`;
        });
        
        const blob = new Blob([csv], { type: 'text/csv' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'expenses_' + new Date().toISOString().split('T')[0] + '.csv';
        a.click();
    }

    // Clear all data
    function clearAllData() {
        if (confirm('⚠️ Are you sure? This will delete ALL expenses permanently!')) {
            window.location.href = 'settings.php?action=clear_confirm';
        }
    }

    // Chart
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
                    type: 'pie',
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
