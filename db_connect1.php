<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "yvette_coffee_db";
    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$dbname);
    mysqli_set_charset($conn , 'UTF8');
    // Check connection
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully";
?>