<?php
ob_start(); // catch any accidental output

include '../db_connection.php';
session_start();

// Always send JSON
header('Content-Type: application/json');

// Make sure $con exists and is valid
if (!$con) {
    echo json_encode([
        'success' => false,
        'message' => 'Database conection failed.'
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

$sql = "SELECT user_id, prod_name, price, count 
        FROM prods 
        WHERE user_id = ?";

$stmt = $con->prepare($sql);

if (!$stmt) {
    echo json_encode([
        'success' => false,
        'message' => 'Prepare failed: ' . $con->error
    ]);
    exit;
}

$stmt->bind_param("i", $customer_id);

if (!$stmt->execute()) {
    echo json_encode([
        'success' => false,
        'message' => 'Execute failed: ' . $stmt->error
    ]);
    $stmt->close();
    $con->close();
    exit;
}

$stmt->store_result();
$stmt->bind_result($user_id, $prod_name, $price, $count);

$rows = [];
while ($stmt->fetch()) {
    $rows[] = [
        'user_id'   => $user_id,
        'prod_name' => $prod_name,
        'price'     => $price,
        'count'     => $count
    ];
}

$stmt->close();
$con->close();

echo json_encode([
    'success' => true,
    'data' => $rows
]);
exit;
