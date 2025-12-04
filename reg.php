<?php
    include 'db_connection.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = password_hash($_POST['pw'], PASSWORD_BCRYPT);
        $check_sql = "SELECT * FROM users WHERE email='$email' and fname='$fname' and lname='$lname'";
        $result = mysqli_query($con, $check_sql);

        if (mysqli_num_rows($result) > 0) {
            header("Location: register.php?error=2");
            exit();
        }
        $sql = "INSERT INTO users (fname, lname, email, password) VALUES ('$fname','$lname', '$email', '$password')";

        if (mysqli_query($con, $sql)) {
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    } 
?>