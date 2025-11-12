<?php
/**
 * Add Expense Page - UNIT-II: Forms, GET/POST Methods, Form Validation
 */
$pageTitle = "Add Expense";
include '../includes/config.php';

$message = "";
$errorMessage = "";

// UNIT-II: POST Method for form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_expense'])) {
        try {
            $date = trim($_POST['date']) ?: date('Y-m-d');
            $category = trim($_POST['category']);
            $description = trim($_POST['description']);
            $amount = trim($_POST['amount']);
            $notes = trim($_POST['notes'] ?? '');

            // UNIT-I: Regular expression validation
            if (!preg_match('/^[a-zA-Z0-9\s\-,\.]+$/', $description)) {
                throw new Exception("Invalid characters in description");
            }

            $tracker->addExpense($date, $category, $description, $amount, $notes);
            $message = "✓ Expense added successfully!";
        } catch (Exception $e) {
            $errorMessage = "✗ Error: " . htmlspecialchars($e->getMessage());
        }
    }
}

include '../includes/header.php';
?>

<h2 class="text-white mb-4"><i class="fas fa-plus-circle"></i> Add New Expense</h2>

<?php if ($message): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo htmlspecialchars($message); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if ($errorMessage): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo htmlspecialchars($errorMessage); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="card-custom">
    <div class="card-body p-5">
        <!-- UNIT-II: HTML Form with POST method -->
        <form method="POST" action="add_expense.php" id="expenseForm">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="date" class="form-label fw-600">Date</label>
                    <input type="date" class="form-control form-control-custom" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="category" class="form-label fw-600">Category</label>
                    <!-- UNIT-I: Associated Arrays in HTML select -->
                    <select class="form-control form-control-custom" id="category" name="category" required>
                        <option value="">Select a category</option>
                        <?php foreach ($categories as $key => $cat): ?>
                            <option value="<?php echo htmlspecialchars($key); ?>">
                                <?php echo htmlspecialchars($cat['icon']) . ' ' . htmlspecialchars($cat['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label fw-600">Description</label>
                <input type="text" class="form-control form-control-custom" id="description" name="description" placeholder="What did you spend on?" maxlength="100" required>
                <small class="text-muted">Max 100 characters</small>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="amount" class="form-label fw-600">Amount (₹)</label>
                    <input type="number" class="form-control form-control-custom" id="amount" name="amount" placeholder="0.00" step="0.01" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="notes" class="form-label fw-600">Notes (Optional)</label>
                    <input type="text" class="form-control form-control-custom" id="notes" name="notes" placeholder="Additional details...">
                </div>
            </div>

            <button type="submit" name="add_expense" class="btn btn-custom btn-primary w-100 mt-3">
                <i class="fas fa-check"></i> Add Expense
            </button>
        </form>
    </div>
</div>

<script>
    // UNIT-I: Form validation with JavaScript
    document.getElementById('expenseForm').addEventListener('submit', function(e) {
        const description = document.getElementById('description').value.trim();
        const amount = parseFloat(document.getElementById('amount').value);
        
        if (!description || description.length > 100) {
            alert('Description must be 1-100 characters');
            e.preventDefault();
            return false;
        }
        
        if (isNaN(amount) || amount <= 0) {
            alert('Amount must be a positive number');
            e.preventDefault();
            return false;
        }
    });
</script>

<?php include '../includes/footer.php'; ?>
