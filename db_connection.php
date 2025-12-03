<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "commerce";

    $con = mysqli_connect($server, $username, $password, $database);
    if(!$con){
        die("Connection to database failed due to " . mysqli_connect_error());
    }
?>