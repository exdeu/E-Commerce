<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS commerce";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully\n";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->select_db("commerce");

// Create users table
$users_sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(100) NOT NULL,
    lname VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    time DATETIME DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($users_sql) === TRUE) {
    echo "Users table created successfully\n";
} else {
    echo "Error creating users table: " . $conn->error;
}

// Create prods table
$prods_sql = "CREATE TABLE IF NOT EXISTS prods (
    prod_name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    img VARCHAR(255),
    count INT NOT NULL,
    time DATETIME,
    FOREIGN KEY (user_id) REFERENCES users(id)
)";

if ($conn->query($prods_sql) === TRUE) {
    echo "Prods table created successfully\n";
} else {
    echo "Error creating prods table: " . $conn->error;
}

// Create checkout table
$checkout_sql = "CREATE TABLE IF NOT EXISTS checkout (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    prod_name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    count INT NOT NULL,
    time_stamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
)";

if ($conn->query($checkout_sql) === TRUE) {
    echo "Checkout table created successfully\n";
} else {
    echo "Error creating checkout table: " . $conn->error;
}

$conn->close();
header("Location: home.html");
exit();
?>