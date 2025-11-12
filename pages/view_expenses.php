<?php
/**
 * View Expenses Page - UNIT-I: Arrays, foreach loops, UNIT-II: GET Method
 */
$pageTitle = "View Expenses";
include '../includes/config.php';

// UNIT-II: GET Method for delete action
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action']) && $_GET['action'] === 'delete') {
    if (isset($_GET['id'])) {
        $tracker->deleteExpense($_GET['id']);
        header("Location: view_expenses.php");
        exit;
    }
}

include '../includes/header.php';

$expenses = $tracker->getExpenses();
?>

<h2 class="text-white mb-4"><i class="fas fa-list"></i> All Expenses</h2>

<div class="card-custom">
    <div class="card-body p-4">
        <!-- Search input -->
        <div class="mb-4">
            <input type="text" class="form-control form-control-custom" id="searchInput" placeholder="🔍 Search expenses...">
        </div>

        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Notes</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="expensesTable">
                    <?php
                    if (empty($expenses)) {
                        echo '<tr><td colspan="6" class="text-center text-muted py-5">No expenses found. <a href="add_expense.php">Add one now!</a></td></tr>';
                    } else {
                        // UNIT-I: foreach loop for displaying array items
                        foreach (array_reverse($expenses) as $expense) {
                            $catData = $categories[$expense->getCategory()];
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($expense->getDate()) . '</td>';
                            echo '<td><span class="badge" style="background-color: ' . htmlspecialchars($catData['color']) . '; color: white;">';
                            echo htmlspecialchars($catData['icon']) . ' ' . htmlspecialchars($catData['name']);
                            echo '</span></td>';
                            echo '<td><strong>' . htmlspecialchars($expense->getDescription()) . '</strong></td>';
                            echo '<td><strong>₹' . number_format($expense->getAmount(), 2) . '</strong></td>';
                            echo '<td><small>' . (htmlspecialchars($expense->getNotes()) ?: '-') . '</small></td>';
                            echo '<td>';
                            echo '<a href="view_expenses.php?action=delete&id=' . htmlspecialchars($expense->getId()) . '" class="btn btn-sm btn-danger btn-custom" onclick="return confirm(\'Delete this expense?\')">';
                            echo '<i class="fas fa-trash"></i>';
                            echo '</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Real-time search functionality (UNIT-IV: AJAX concept)
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('#expensesTable tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
</script>

<?php include '../includes/footer.php'; ?>
