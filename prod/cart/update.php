<?php
ob_start();

include '../../db_connection.php';
session_start();

// Always send JSON
header('Content-Type: application/json');

// Read JSON body
$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['count'], $data['prod_name'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid JSON input. Expected count and prod_name.'
    ]);
    exit;
}

// DB check
if (!$con) {
    echo json_encode([
        'success' => false,
        'message' => 'Database connection failed.'
    ]);
    exit;
}

// Check login
if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'User not logged in.'
    ]);
    exit;
}

$customer_id = (int) $_SESSION['user_id'];
$newCount    = (int) $data['count'];
$prod_name   = $data['prod_name'];

// Optional: ensure count is positive
if ($newCount < 0) {
    echo json_encode([
        'success' => false,
        'message' => 'Count cannot be negative.'
    ]);
    exit;
}

// UPDATE: set new count for this user's specific product
$sql = "UPDATE prods 
        SET count = ? 
        WHERE user_id = ? AND prod_name = ?";

$stmt = $con->prepare($sql);

if (!$stmt) {
    echo json_encode([
        'success' => false,
        'message' => 'Prepare failed: ' . $con->error
    ]);
    exit;
}

// i = int, i = int, s = string
$stmt->bind_param("iis", $newCount, $customer_id, $prod_name);

if (!$stmt->execute()) {
    echo json_encode([
        'success' => false,
        'message' => 'Execute failed: ' . $stmt->error
    ]);
    $stmt->close();
    $con->close();
    exit;
}

// Optional: check that a row was updated
if ($stmt->affected_rows === 0) {
    echo json_encode([
        'success' => false,
        'message' => 'No matching product found to update.'
    ]);
    $stmt->close();
    $con->close();
    exit;
}

$stmt->close();
$con->close();

echo json_encode([
    'success' => true,
    'message' => 'Count updated successfully.',
    'data' => [
        'prod_name' => $prod_name,
        'count'     => $newCount
    ]
]);
exit;
