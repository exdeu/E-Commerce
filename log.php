<?php
    session_start();
    include 'db_connection.php';

    $err = null;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE email=?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_fname'] = $row['fname'];
                $_SESSION['user_lname'] = $row['lname'];
                $_SESSION['user_email'] = $row['email'];
                header("Location: home.php");
                exit();
            } else {
                header("Location: login.php?error=1");
                exit();
            }
        } else {
            header("Location: login.php?error=1");
            exit();
        }
    }
?>