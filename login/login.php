<?php
include '../db_connection.php';
session_start();

header('Content-Type: application/json');


$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (!$data || !isset($data['email'], $data['password'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request data.'
    ]);
    exit();
}

$email    = $data['email'];
$password = $data['password'];

$sql  = "SELECT * FROM users WHERE email = ?";
$stmt = mysqli_prepare($con, $sql);

if (!$stmt) {
    echo json_encode([
        'status'  => 'error',
        'message' => 'Prepare failed: ' . mysqli_error($con)
    ]);
    exit();
}

mysqli_stmt_bind_param($stmt, "s", $email);

if (!mysqli_stmt_execute($stmt)) {
    echo json_encode([
        'status'  => 'error',
        'message' => 'Execute failed: ' . mysqli_stmt_error($stmt)
    ]);
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    exit();
}

$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);

    if (password_verify($password, $row['password'])) {
        $_SESSION['user_id']    = $row['id'];
        $_SESSION['user_fname'] = $row['fname'] ?? null;
        $_SESSION['user_lname'] = $row['lname'] ?? null;
        $_SESSION['user_email'] = $row['email'];
        $_SESSION['date']       = $row['time'] ?? null;

        echo json_encode([
            'status'  => 'success',
            'message' => 'Valid credentials'
        ]);
    } else {
        echo json_encode([
            'status'  => 'error',
            'message' => 'Invalid password'
        ]);
    }
} else {
    echo json_encode([
        'status'  => 'error',
        'message' => 'User not found'
    ]);
}


mysqli_stmt_close($stmt);
mysqli_close($con);
exit();
