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
        empty($input['new_password'])
    ) {
        throw new Exception('Missing required fields: email, new_password');
    }

    $email          = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
    $new_password   = $input['new_password'];    // plain text from user


    $stmt = $con->prepare('SELECT id FROM users WHERE email = ?');
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

    $new_hash = password_hash($new_password, PASSWORD_BCRYPT);

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
