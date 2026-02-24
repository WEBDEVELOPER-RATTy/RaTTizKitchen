<?php
$servername = "localhost";
$username = "root";    // XAMPP default
$password = "";        // XAMPP default
$database = "my_backend_site";  // replace with your database

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>