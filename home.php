<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Store</title>
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
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="products.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <?php if(isset($_SESSION['user_id'])) echo '<li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>'?>
                    <?php if(isset($_SESSION['user_id'])) echo '<li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>'?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo isset($_SESSION['user_id']) ? "logout.php" : "login.php"?>"><?php echo isset($_SESSION['user_id']) ? "Log Out" : "Log In"?></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-light py-5">
        <div class="container text-center">
            <h1 class="display-4 mb-4">Welcome to ShopHub</h1>
            <p class="lead mb-4">Discover amazing products at unbeatable prices</p>
            <a href="products.php" class="btn btn-primary btn-lg">Shop Now</a>
        </div>
    </section>

    <!-- Promotional Section -->
    <section class="py-5">
        <div class="container text-center">
            <h2 class="mb-4">Exclusive Offers</h2>
            <p class="lead mb-4">Sign up now to receive exclusive discounts and updates!</p>
            <a href="register.php" class="btn btn-success btn-lg">Join Us</a>
        </div>
    </section>
    
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
            <p class="text-center mb-4">&copy; 2024 ShopHub. All rights reserved.</p>
        </div>
    </footer>

    <script src="bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
