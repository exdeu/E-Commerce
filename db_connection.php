<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "commerce";

    $con = mysqli_connect($server, $username, $password, $database);
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>