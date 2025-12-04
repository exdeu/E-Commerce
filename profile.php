<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="bootstrap-5.3.8-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">ShopHub</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="products.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <?php if(isset($_SESSION['user_id'])) echo '<li class="nav-item"><a class="nav-link active" href="profile.php">Profile</a></li>'?>
                    <?php if(isset($_SESSION['user_id'])) echo '<li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>'?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo isset($_SESSION['user_id']) ? "logout.php" : "login.php"?>"><?php echo isset($_SESSION['user_id']) ? "Log Out" : "Log In"?></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="user_img/def.jpg" class="card-img-top" alt="Profile Picture">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo $_SESSION['user_fname']." ".$_SESSION['user_lname']?></h5>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5>Account Information</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Email:</strong> <?php echo $_SESSION['user_email'] ?></p>
                        <p><strong>Member Since:</strong> <?php echo $_SESSION['date'] ?></p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5>Recent Orders</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#ORD001</td>
                                    <td>Dec 10, 2023</td>
                                    <td>$49.99</td>
                                    <td><span class="badge bg-success">Delivered</span></td>
                                </tr>
                                <tr>
                                    <td>#ORD002</td>
                                    <td>Dec 5, 2023</td>
                                    <td>$89.99</td>
                                    <td><span class="badge bg-info">Shipped</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer id="about" class="bg-dark text-white mt-5 p-5">
        <div class="container p-5">
            <div class="row mb-4">
                <div class="col-md-4">
                    <h5>About ShopHub</h5>
                    <p>Your trusted online shopping destination for quality products.</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white-50">Privacy Policy</a></li>
                        <li><a href="#" class="text-white-50">Terms of Service</a></li>
                        <li><a href="#" class="text-white-50">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Follow Us</h5>
                    <p>
                        <a href="#" class="text-white-50 me-2">Facebook</a>
                        <a href="#" class="text-white-50 me-2">Twitter</a>
                        <a href="#" class="text-white-50">Instagram</a>
                    </p>
                </div>
            </div>
            <hr class="bg-white-50">
            <p class="text-center mb-5">&copy; 2024 ShopHub. All rights reserved.</p>
        </div>
    </footer>
    <script src="bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>