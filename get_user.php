<?php
session_start();

header('Content-Type: application/json');

$response = [];

if (isset($_SESSION['user_id'])) {
    $response['status'] = 'success';
    $response['id']     = $_SESSION['user_id'];
    $response['fname']  = $_SESSION['user_fname'] ?? null;
    $response['lname']  = $_SESSION['user_lname'] ?? null;
    $response['email']  = $_SESSION['user_email'] ?? null;
    $response['date']   = $_SESSION['date'] ?? null;
} else {
    $response['status']  = 'error';
    $response['message'] = 'User not logged in';
}

echo json_encode($response);
exit;
?>
