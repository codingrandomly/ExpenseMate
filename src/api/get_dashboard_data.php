<?php
header('Content-Type: application/json');
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Unauthorized access']);
    exit;
}

require_once '../../src/config/db.php';

$user_id = $_SESSION['user_id'];

function getExpenseSum($conn, $user_id, $condition = "1") {
    $sql = "SELECT COALESCE(SUM(amount), 0) AS total FROM expenses WHERE user_id = ? AND $condition";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    return $result['total'];
}

try {
    $today = getExpenseSum($conn, $user_id, "DATE(expense_date) = CURDATE()");
    $yesterday = getExpenseSum($conn, $user_id, "DATE(expense_date) = CURDATE() - INTERVAL 1 DAY");
    $week = getExpenseSum($conn, $user_id, "YEARWEEK(expense_date, 1) = YEARWEEK(CURDATE(), 1)");
    $month = getExpenseSum($conn, $user_id, "MONTH(expense_date) = MONTH(CURDATE()) AND YEAR(expense_date) = YEAR(CURDATE())");
    $year = getExpenseSum($conn, $user_id, "YEAR(expense_date) = YEAR(CURDATE())");
    $total = getExpenseSum($conn, $user_id);

    echo json_encode([
        'today' => (float)$today,
        'yesterday' => (float)$yesterday,
        'week' => (float)$week,
        'month' => (float)$month,
        'year' => (float)$year,
        'total' => (float)$total
    ]);

} catch (Exception $e) {
    echo json_encode(['error' => 'Failed to load data']);
}
?>
