<?php
include '../db_connection.php';
session_start();

header('Content-Type: application/json');

if (!$con) {
    echo json_encode([
        'success' => false,
        'message' => 'Database connection failed'
    ]);
    exit;
}

if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'User not logged in'
    ]);
    exit;
}

$user_id = (int) $_SESSION['user_id'];


$sql = "SELECT prod_name, price, count, time_stamp, order_id
        FROM checkout 
        WHERE user_id = ?";

$stmt = $con->prepare($sql);

if (!$stmt) {
    echo json_encode([
        'success' => false,
        'message' => 'Prepare failed: ' . $con->error
    ]);
    exit;
}

$stmt->bind_param("i", $user_id);

if (!$stmt->execute()) {
    echo json_encode([
        'success' => false,
        'message' => 'Execute failed: ' . $stmt->error
    ]);
    $stmt->close();
    $con->close();
    exit;
}

$result = $stmt->get_result();

$orders = [];
while ($row = $result->fetch_assoc()) {
    $orders[] = $row;
}

$stmt->close();
$con->close();

echo json_encode([
    'success' => true,
    'data' => $orders
]);
exit;
?>
