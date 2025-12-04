<?php
    session_start();
    include 'db_connection.php';

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-Commerce Store</title>
    <link href="bootstrap-5.3.8-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-sm" style="width: 100%; max-width: 400px;">
            <div class="card-body p-5">
                <h2 class="text-center mb-4">Login</h2>
                <form method = "POST" action="login.php">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" >
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mb-3">Login</button>
                    <?php
                        if (isset($_GET['error']) && $_GET['error'] == 1) {
                            echo '<div class="alert alert-danger text-center" role="alert">
                                    Wrong password or email.
                                  </div>';
                        }
                    ?>
                </form>
                <hr>
                <p class="text-center mb-0">Don't have an account? <a href="register.php">Sign up here</a></p>
                <p class="text-center"><a href="#forgot">Forgot password?</a></p>
            </div>
        </div>
    </div>
     <footer id = "about" class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p>&copy; 2024 ShopHub. All rights reserved.</p>
        </div>
    </footer>
    <script src="bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>