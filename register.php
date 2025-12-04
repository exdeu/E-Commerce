
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="bootstrap-5.3.8-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-sm" style="width: 100%; max-width: 400px;">
            <div class="card-body p-5">
                 <?php
                        if (isset($_GET['error']) && $_GET['error'] == 2) {
                            echo '<div class="alert alert-danger text-center" role="alert">
                                    Account already exists.
                                  </div>';
                        }
                    ?>
                <h2 class="card-title text-center mb-4">Create Account</h2>
                <form id = "reg" method="POST" action="reg.php">
                    <div class="mb-3">
                        <label for="full_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter your full name" required>
                    </div>
                    <div class="mb-3">
                        <label for="full_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter your full name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label for="pw" class="form-label">Password</label>
                        <input type="password" class="form-control" id="pw" name="pw" placeholder="Enter password" required>
                        <div id="password-validation" class="mt-2" style="display: none;">
                            <small class="text-danger">Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character.</small>
                        </div>
                        <script>
                            const passwordInput = document.getElementById('pw');
                            const validationMessage = document.getElementById('password-validation');
                            let confirmed = false;
                            passwordInput.addEventListener('input', function() {
                                const password = passwordInput.value;
                                const isValid = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(password);
                                validationMessage.style.display = isValid ? 'none' : 'block';
                                if(isValid) confirmed = true;
                                else confirmed = false;
                            });

                            function confirm() {
                                if (confirmed) {
                                    document.getElementById('reg').submit();
                                } else {
                                    alert('Please enter a valid password before registering.');
                                }
                            }
                        </script>
                    </div>
                    <div class="mb-3">
                        <label for="confirm-password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm-password" placeholder="Confirm password" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="agree" required>
                        <label class="form-check-label" for="agree">I agree to the terms and conditions</label>
                    </div>
                    <button type="button" class="btn btn-primary w-100" onclick="confirm()">Register</button>
                </form>
                <p class="text-center mt-3">Already have an account? <a href="login.php">Login here</a></p>
            </div>
        </div>
    </div>
    <script src="bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>