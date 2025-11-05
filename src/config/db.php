<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'Lalit@123');
define('DB_NAME', 'expensemate');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_errno) {
    die('Database connection failed: ' . $conn->connect_error);
}

if (!$conn->set_charset('utf8mb4')) {
    die('Error loading character set utf8mb4: ' . $conn->error);
}

function run_prepared_query($query, $types = '', $params = []) {
    global $conn;

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        error_log('Prepare failed: ' . $conn->error);
        return false;
    }

    if (!empty($types) && !empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    if (!$stmt->execute()) {
        error_log('Execute failed: ' . $stmt->error);
        return false;
    }

    return $stmt;
}
?>
