<?php
/**
 * Settings Page - UNIT-II: Cookies, State Management
 */
$pageTitle = "Settings";
include '../includes/config.php';

// Handle clear all data
if (isset($_GET['action']) && $_GET['action'] === 'clear_confirm') {
    $tracker->clearAllExpenses();
    header("Location: settings.php?cleared=1");
    exit;
}

include '../includes/header.php';
?>

<h2 class="text-white mb-4"><i class="fas fa-cog"></i> Settings</h2>

<?php if (isset($_GET['cleared'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        ✓ All data has been cleared successfully!
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card-custom">
            <div class="card-body p-4">
                <h5 class="card-title"><i class="fas fa-palette"></i> Theme Settings</h5>
                <div class="mt-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="darkModeToggle" onchange="toggleDarkMode()">
                        <label class="form-check-label" for="darkModeToggle">
                            Enable Dark Mode
                        </label>
                    </div>
                    <small class="text-muted">Your preference will be saved automatically</small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card-custom">
            <div class="card-body p-4">
                <h5 class="card-title"><i class="fas fa-info-circle"></i> About ExpenseMate</h5>
                <div class="mt-4">
                    <p class="mb-2"><strong>Version:</strong> 1.0</p>
                    <p class="mb-2"><strong>Type:</strong> Educational Project</p>
                    <p class="mb-0"><strong>Curriculum:</strong> UNIT-I to UNIT-IV</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card-custom">
            <div class="card-body p-4">
                <h5 class="card-title"><i class="fas fa-book"></i> Features</h5>
                <div class="mt-4">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-check text-success"></i> Dashboard with statistics</li>
                                <li class="mb-2"><i class="fas fa-check text-success"></i> Add and manage expenses</li>
                                <li class="mb-2"><i class="fas fa-check text-success"></i> Multiple categories</li>
                                <li class="mb-2"><i class="fas fa-check text-success"></i> Real-time search</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-check text-success"></i> Visual charts and reports</li>
                                <li class="mb-2"><i class="fas fa-check text-success"></i> CSV download</li>
                                <li class="mb-2"><i class="fas fa-check text-success"></i> Dark mode support</li>
                                <li class="mb-2"><i class="fas fa-check text-success"></i> Persistent storage</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card-custom border-danger">
            <div class="card-body p-4">
                <h5 class="card-title text-danger"><i class="fas fa-warning"></i> Danger Zone</h5>
                <div class="mt-4">
                    <button class="btn btn-danger btn-custom" onclick="if(confirm('Delete ALL data?')) window.location.href='settings.php?action=clear_confirm'">
                        <i class="fas fa-trash"></i> Clear All Expenses
                    </button>
                    <small class="d-block mt-2 text-muted">This action cannot be undone. All expense data will be permanently deleted.</small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // UNIT-II: Cookies for theme preference
    function toggleDarkMode() {
        document.body.classList.toggle('dark-mode');
        const isDark = document.body.classList.contains('dark-mode');
        document.cookie = "darkMode=" + isDark + "; path=/; max-age=" + (60*60*24*365);
        
        // Update checkbox state
        document.getElementById('darkModeToggle').checked = isDark;
    }

    // Load preferences on page load
    window.addEventListener('load', function() {
        const isDarkMode = document.body.classList.contains('dark-mode');
        document.getElementById('darkModeToggle').checked = isDarkMode;
    });
</script>

<?php include '../includes/footer.php'; ?>
