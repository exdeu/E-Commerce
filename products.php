<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - E-Commerce Store</title>
    <link href="bootstrap-5.3.8-dist/css/bootstrap.min.css" rel="stylesheet">
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
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Store</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo isset($_SESSION['user_id']) ? "logout.php" : "login.php"?>"><?php echo isset($_SESSION['user_id']) ? "Log Out" : "Log In"?></a></li>
                    <?php if(isset($_SESSION['user_id'])) echo '<li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>'?>
                </ul>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Products Section -->
    <div class="container my-5">
        <h1 class="mb-4">Our Products</h1>
        
        <div class="row g-4">
            <!-- Product Card 1 -->
            <div class="col-md-6 col-lg-4">
                <div class="card product-card">
                    <img src="https://via.placeholder.com/300x250" class="card-img-top product-image" alt="Product">
                    <div class="card-body">
                        <h5 class="card-title">Product 1</h5>
                        <p class="card-text">High quality product description goes here.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h5 mb-0">$29.99</span>
                            <button class="btn btn-primary btn-sm">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Card 2 -->
            <div class="col-md-6 col-lg-4">
                <div class="card product-card">
                    <img src="https://via.placeholder.com/300x250" class="card-img-top product-image" alt="Product">
                    <div class="card-body">
                        <h5 class="card-title">Product 2</h5>
                        <p class="card-text">High quality product description goes here.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h5 mb-0">$39.99</span>
                            <button class="btn btn-primary btn-sm">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Card 3 -->
            <div class="col-md-6 col-lg-4">
                <div class="card product-card">
                    <img src="https://via.placeholder.com/300x250" class="card-img-top product-image" alt="Product">
                    <div class="card-body">
                        <h5 class="card-title">Product 3</h5>
                        <p class="card-text">High quality product description goes here.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h5 mb-0">$49.99</span>
                            <button class="btn btn-primary btn-sm">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Card 4 -->
            <div class="col-md-6 col-lg-4">
                <div class="card product-card">
                    <img src="https://via.placeholder.com/300x250" class="card-img-top product-image" alt="Product">
                    <div class="card-body">
                        <h5 class="card-title">Product 4</h5>
                        <p class="card-text">High quality product description goes here.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h5 mb-0">$34.99</span>
                            <button class="btn btn-primary btn-sm">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Card 5 -->
            <div class="col-md-6 col-lg-4">
                <div class="card product-card">
                    <img src="https://via.placeholder.com/300x250" class="card-img-top product-image" alt="Product">
                    <div class="card-body">
                        <h5 class="card-title">Product 5</h5>
                        <p class="card-text">High quality product description goes here.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h5 mb-0">$44.99</span>
                            <button class="btn btn-primary btn-sm">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Card 6 -->
            <div class="col-md-6 col-lg-4">
                <div class="card product-card">
                    <img src="https://via.placeholder.com/300x250" class="card-img-top product-image" alt="Product">
                    <div class="card-body">
                        <h5 class="card-title">Product 6</h5>
                        <p class="card-text">High quality product description goes here.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h5 mb-0">$59.99</span>
                            <button class="btn btn-primary btn-sm">Add to Cart</button>
                        </div>
                    </div>
                </div>
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