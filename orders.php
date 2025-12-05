<?php
include 'db_connection.php';
session_start();

// Always send JSON for this endpoint
header('Content-Type: application/json');

// Check login
if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'User not logged in.'
    ]);
    exit;
}

// Get JSON body
$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (!$data || !isset($data['name'], $data['price'], $data['image_url'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid input data.'
    ]);
    exit;
}

$customer_id = (int) $_SESSION['user_id'];
$prod_name   = $data['name'];
$prod_price  = (float) $data['price'];  
$prod_img    = $data['image_url'];

// 1) Check if product already exists for this user
$check_sql = "SELECT user_id, prod_name FROM prods WHERE user_id = ? AND prod_name = ?";
$check_stmt = $con->prepare($check_sql);
$check_stmt->bind_param("is", $customer_id, $prod_name);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result && $check_result->num_rows > 0) {
    // 2a) Update count
    $sql  = "UPDATE prods SET count = count + 1 WHERE user_id = ? AND prod_name = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("is", $customer_id, $prod_name);
} else {
    // 2b) Insert new row, set count = 1
    $sql  = "INSERT INTO prods (prod_name, price, user_id, img, count) VALUES (?, ?, ?, ?, 1)";
    $stmt = $con->prepare($sql);
    // s = string, d = double, i = integer, s = string
    $stmt->bind_param("sdis", $prod_name, $prod_price, $customer_id, $prod_img);
}

// Execute and respond
if ($stmt->execute()) {
    echo json_encode([
        'success' => true,
        'message' => 'Order added successfully.'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Error: ' . $stmt->error
    ]);
}

$stmt->close();
$check_stmt->close();
$con->close();
exit;
