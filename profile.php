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
                    <li class="nav-item"><a class="nav-link" href="<?php echo isset($_SESSION['user_id']) ? "logout.php" : "login.php"?>"><?php echo isset($_SESSION['user_id']) ? "Log Out" : "Log In"?></a></li>
                    <?php if(isset($_SESSION['user_id'])) echo '<li class="nav-item"><a class="nav-link active" href="profile.php">Profile</a></li>'?>
                </ul>
                </ul>
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
                        <button class="btn btn-primary btn-sm">Edit Profile</button>
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
                        <p><strong>Member Since:</strong> January 15, 2023</p>
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
     <footer id = "about" class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p>&copy; 2024 ShopHub. All rights reserved.</p>
        </div>
    </footer>
    <script src="bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>