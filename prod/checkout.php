<?php
ob_start();

include '../db_connection.php';
session_start();

header('Content-Type: application/json');

// Check DB
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

$customer_id = (int) $_SESSION['user_id'];

// Select items from prods
$sql = "SELECT user_id, prod_name, price, count 
        FROM prods 
        WHERE user_id = ?";

$stmt = $con->prepare($sql);
if (!$stmt) {
    ob_clean();
    echo json_encode([
        'success' => false,
        'message' => 'Prepare failed (select): ' . $con->error
    ]);
    exit;
}

$stmt->bind_param("i", $customer_id);

if (!$stmt->execute()) {
    ob_clean();
    echo json_encode([
        'success' => false,
        'message' => 'Execute failed (select): ' . $stmt->error
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

// If nothing to checkout
if (empty($rows)) {
    ob_clean();
    echo json_encode([
        'success' => true,
        'data'    => [],
        'message' => 'No items to checkout.'
    ]);
    $con->close();
    exit;
}

// Start transaction
$con->begin_transaction();

try {
    // Prepare insert into checkout
    $insert_sql = "INSERT INTO checkout (user_id, prod_name, price, count) VALUES (?, ?, ?, ?)";
    $insert_stmt = $con->prepare($insert_sql);
    if (!$insert_stmt) {
        throw new Exception('Prepare failed (insert): ' . $con->error);
    }

    // Prepare delete from prods
    $delete_sql = "DELETE FROM prods WHERE user_id = ? AND prod_name = ?";
    $delete_stmt = $con->prepare($delete_sql);
    if (!$delete_stmt) {
        throw new Exception('Prepare failed (delete): ' . $con->error);
    }

    foreach ($rows as $row) {
        $insert_stmt->bind_param("isdi", $row['user_id'], $row['prod_name'], $row['price'], $row['count']);
        if (!$insert_stmt->execute()) {
            throw new Exception('Insert failed: ' . $insert_stmt->error);
        }

        $delete_stmt->bind_param("is", $row['user_id'], $row['prod_name']);
        if (!$delete_stmt->execute()) {
            throw new Exception('Delete failed: ' . $delete_stmt->error);
        }
    }

    $insert_stmt->close();
    $delete_stmt->close();

    // All good → commit
    $con->commit();

    ob_clean();
    echo json_encode([
        'success' => true,
        'data'    => $rows
    ]);
} catch (Exception $e) {
    // Something failed → rollback
    $con->rollback();
    ob_clean();
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

$con->close();
exit;
?>
