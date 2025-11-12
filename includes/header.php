<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) . ' - ' : ''; ?>ExpenseMate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
    <style>
        :root {
            --primary: #667eea;
            --secondary: #764ba2;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body.dark-mode {
            background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
            color: #e2e8f0;
        }

        .navbar-custom {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        body.dark-mode .navbar-custom {
            background: rgba(26, 32, 44, 0.95);
        }

        .card-custom {
            background: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        body.dark-mode .card-custom {
            background: rgba(45, 55, 72, 0.95);
            color: #e2e8f0;
        }

        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

        .btn-custom {
            border-radius: 25px;
            padding: 8px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .stat-box {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            margin-bottom: 15px;
        }

        .stat-box h6 {
            font-size: 0.9rem;
            opacity: 0.9;
            margin-bottom: 10px;
        }

        .stat-box h3 {
            font-size: 1.8rem;
            font-weight: 700;
        }

        .form-control-custom {
            border-radius: 8px;
            border: 2px solid #e2e8f0;
            padding: 10px 15px;
        }

        body.dark-mode .form-control-custom {
            background: rgba(60, 70, 90, 0.5);
            border-color: #4a5568;
            color: #e2e8f0;
        }

        .form-control-custom:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        body.dark-mode table {
            color: #e2e8f0;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(102, 126, 234, 0.1);
        }
    </style>
</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light navbar-custom sticky-top">
    <div class="container-lg">
        <a class="navbar-brand fw-bold" href="dashboard.php">
            <i class="fas fa-wallet"></i> ExpenseMate
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php"><i class="fas fa-chart-pie"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add_expense.php"><i class="fas fa-plus-circle"></i> Add Expense</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view_expenses.php"><i class="fas fa-list"></i> View</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="reports.php"><i class="fas fa-chart-bar"></i> Reports</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="settings.php"><i class="fas fa-cog"></i> Settings</a>
                </li>
                <li class="nav-item">
                    <button class="btn btn-sm btn-outline-primary ms-2" onclick="toggleDarkMode()">
                        <i class="fas fa-moon"></i>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-lg mt-5">
