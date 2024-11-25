<?php
// Database connection details
$host = "localhost"; // Hostname
$username = "root";  // XAMPP default username
$password = "";      // XAMPP default password
$database = "app1"; // Your database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
