<?php

session_start();
require_once "../src/config/db.php";
require_once "../src/helpers/sanitize.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$categoryData = [];
$stmt = $conn->prepare("SELECT category, SUM(amount) AS total FROM expenses WHERE user_id = ? GROUP BY category");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $categoryData[$row['category']] = $row['total'];
}
$stmt->close();

$dateData = [];
$stmt = $conn->prepare("SELECT expense_date, SUM(amount) AS total FROM expenses WHERE user_id = ? GROUP BY expense_date ORDER BY expense_date DESC LIMIT 10");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $dateData[$row['expense_date']] = $row['total'];
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Reports | ExpenseMate</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
    
        .report-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .report-header h2 {
            font-size: 2rem;
            color: #ffffff;
        }

        .chart-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 25px;
            padding: 20px;
        }

        .chart-card {
            background: #1e1e1e;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .chart-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.6);
        }

        .chart-card h3 {
            color: #03A9F4;
            margin-bottom: 15px;
            text-align: center;
        }

        canvas {
            width: 100%;
            height: 300px;
        }

        @media (max-width: 600px) {
            .report-header h2 {
                font-size: 1.5rem;
            }

            canvas {
                height: 250px;
            }
        }
    </style>
</head>

<body>
    <?php include "../includes/navbar.php"; ?>

    <div class="container">
        <div class="report-header">
            <h2>Expense Reports</h2>
            <p style="color:#aaa;">Visual summary of your spending</p>
        </div>

        <div class="chart-grid">
            <div class="chart-card">
                <h3>Category-wise Expense</h3>
                <canvas id="categoryChart"></canvas>
            </div>

            <div class="chart-card">
                <h3>Recent 10 Days Expense</h3>
                <canvas id="dateChart"></canvas>
            </div>
        </div>
    </div>

    <?php include "../includes/footer.php"; ?>

    <script>

        const categoryLabels = <?= json_encode(array_keys($categoryData)); ?>;
        const categoryValues = <?= json_encode(array_values($categoryData)); ?>;

        const ctxCategory = document.getElementById('categoryChart').getContext('2d');
        new Chart(ctxCategory, {
            type: 'pie',
            data: {
                labels: categoryLabels,
                datasets: [{
                    data: categoryValues,
                    backgroundColor: [
                        '#4CAF50', '#FF9800', '#03A9F4', '#E91E63', '#9C27B0', '#FFEB3B'
                    ],
                    borderColor: '#222',
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: {
                        labels: {
                            color: '#fff',
                            font: {
                                size: 14
                            }
                        }
                    }
                }
            }
        });

        const dateLabels = <?= json_encode(array_keys($dateData)); ?>;
        const dateValues = <?= json_encode(array_values($dateData)); ?>;

        const ctxDate = document.getElementById('dateChart').getContext('2d');
        new Chart(ctxDate, {
            type: 'bar',
            data: {
                labels: dateLabels.reverse(),
                datasets: [{
                    label: 'Expense (₹)',
                    data: dateValues.reverse(),
                    backgroundColor: '#03A9F4',
                    borderRadius: 8
                }]
            },
            options: {
                scales: {
                    x: {
                        ticks: {
                            color: '#fff'
                        },
                        grid: {
                            color: '#333'
                        }
                    },
                    y: {
                        ticks: {
                            color: '#fff'
                        },
                        grid: {
                            color: '#333'
                        },
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: '#fff'
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>