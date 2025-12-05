<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Hablon E-Commerce Store</title>
    <link href="../bootstrap-5.3.8-dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-card {
            transition: transform 0.2s;
            height: 100%;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .product-image {
            height: 250px;
            object-fit: cover;
        }
        .category-section {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 3px solid #212529;
        }
        .category-title {
            color: #212529;
            margin-bottom: 1rem;
            font-weight: 700;
        }
        .category-description {
            color: #6c757d;
            margin-bottom: 2rem;
            font-style: italic;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">ShopHub</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="../home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="products.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <?php if(isset($_SESSION['user_id'])) echo '<li class="nav-item"><a class="nav-link" href="../info/profile.php">Profile</a></li>'?>
                    <?php if(isset($_SESSION['user_id'])) echo '<li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>'?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo isset($_SESSION['user_id']) ? "../login/logout.php" : "../login/login.php"?>"><?php echo isset($_SESSION['user_id']) ? "Log Out" : "Log In"?></a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Products Section -->
    <div id = "catalog-container" class="container my-5">
        <script src="catalog.js"></script>
        <script><?php if(isset($_SESSION['user_id'])) 
            echo "logged = true;";
        ?>
        </script>
    </div>

    <!-- Footer -->
    <footer id="about" class="bg-dark text-white mt-5 p-5">
        <div class="container p-5">
            <div class="row mb-4">
                <div class="col-md-4">
                    <h5>About Hablon Store</h5>
                    <p>Your trusted source for authentic handwoven Hablon fabrics and products.</p>
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
            <p class="text-center mb-4">&copy; 2024 Hablon Store. All rights reserved.</p>
        </div>
    </footer>

    <script src="../bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>