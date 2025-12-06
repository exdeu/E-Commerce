<?php
include '../db_connection.php';
session_start();

header('Content-Type: application/json');

// If user is logged in, log them out
if (isset($_SESSION['user_id'])) {
    $_SESSION = [];
    session_destroy();
}

$data = json_decode(file_get_contents('php://input'), true);

if (!is_array($data)) {
    echo json_encode([
        "success" => false,
        "message" => "Invalid JSON payload"
    ]);
    exit();
}

$fname    = $data['fname'] ?? null;
$lname    = $data['lname'] ?? null;
$email    = $data['email'] ?? null;
$password = $data['pw'] ?? null;

// Validate required fields
if (!$fname || !$lname || !$email || !$password) {
    echo json_encode([
        "success" => false,
        "message" => "Missing required fields"
    ]);
    exit();
}

$hashed_pw = password_hash($password, PASSWORD_BCRYPT);


$check_sql = "SELECT id FROM users WHERE email = ?";
$stmt = $con->prepare($check_sql);

if (!$stmt) {
    echo json_encode([
        "success" => false,
        "message" => "Prepare failed: " . $con->error
    ]);
    exit();
}

$stmt->bind_param("s", $email);
if (!$stmt->execute()) {
    echo json_encode([
        "success" => false,
        "message" => "Execute failed: " . $stmt->error
    ]);
    $stmt->close();
    exit();
}

$stmt->store_result(); 
if ($stmt->num_rows > 0) {
    $stmt->close();
    echo json_encode([
        "success" => false,
        "message" => "User already exists"
    ]);
    exit();
}
$stmt->close();

$insert_sql = "INSERT INTO users (fname, lname, email, password) VALUES (?, ?, ?, ?)";
$stmt = $con->prepare($insert_sql);

if (!$stmt) {
    echo json_encode([
        "success" => false,
        "message" => "Prepare failed: " . $con->error
    ]);
    exit();
}

$stmt->bind_param("ssss", $fname, $lname, $email, $hashed_pw);

if ($stmt->execute()) {
    echo json_encode([
        "success" => true,
        "message" => "Registration successful"
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Database error: " . $stmt->error
    ]);
}

$stmt->close();
$con->close();
exit;
?>
