<?php
ob_start(); // catch any accidental output

include '../db_connection.php';
session_start();

// Always send JSON
header('Content-Type: application/json');

// Check DB connection
if (!$con) {
    ob_clean();
    echo json_encode([
        'success' => false,
        'message' => 'Database connection failed.'
    ]);
    exit;
}

// Check login
if (!isset($_SESSION['user_id'])) {
    ob_clean();
    echo json_encode([
        'success' => false,
        'message' => 'User not logged in.'
    ]);
    exit;
}

// Read JSON body
$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (!$data || !isset($data['prod_name'])) {
    ob_clean();
    echo json_encode([
        'success' => false,
        'message' => 'Invalid input data.'
    ]);
    exit;
}

$customer_id = (int) $_SESSION['user_id'];
$prod_name   = $data['prod_name'];  // product name coming from JS

$sql = "DELETE FROM prods WHERE user_id = ? AND prod_name = ?";

$stmt = $con->prepare($sql);

if (!$stmt) {
    ob_clean();
    echo json_encode([
        'success' => false,
        'message' => 'Prepare failed: ' . $con->error
    ]);
    exit;
}

$stmt->bind_param("is", $customer_id, $prod_name);

if (!$stmt->execute()) {
    ob_clean();
    echo json_encode([
        'success' => false,
        'message' => 'Execute failed: ' . $stmt->error
    ]);
    $stmt->close();
    $conn->close();
    exit;
}

$affected = $stmt->affected_rows; 

$stmt->close();
$con->close();

echo json_encode([
    'success' => true,
    'deleted_rows' => $affected
]);
exit;
