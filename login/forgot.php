<?php
include '../db_connection.php';
header('Content-Type: application/json');

try {
    $input = json_decode(file_get_contents('php://input'), true);

    if (!is_array($input)) {
        throw new Exception('Invalid JSON');
    }

    if (
        empty($input['email']) ||
        empty($input['last_password']) ||
        empty($input['new_password'])
    ) {
        throw new Exception('Missing required fields: email, last_password, new_password');
    }

    $email          = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
    $last_password  = $input['last_password'];   // plain text from user
    $new_password   = $input['new_password'];    // plain text from user

    // 1) Get user & current hash
    $stmt = $con->prepare('SELECT id, `password` FROM users WHERE email = ?');
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $con->error);
    }

    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user   = $result->fetch_assoc();
    $stmt->close();

    if (!$user) {
        throw new Exception('User not found');
    }

    // 2) Verify old password
    if (!password_verify($last_password, $user['password'])) {
        throw new Exception('Last password is incorrect');
    }

    // 3) Hash new password
    $new_hash = password_hash($new_password, PASSWORD_BCRYPT);

    // 4) Update password
    $stmt = $con->prepare('UPDATE users SET `password` = ? WHERE id = ?');
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . $con->error);
    }

    $stmt->bind_param('si', $new_hash, $user['id']);
    $stmt->execute();
    $stmt->close();

    echo json_encode([
        'success' => true,
        'message' => 'Password updated successfully'
    ]);
    exit;

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
    exit;
}
?>
