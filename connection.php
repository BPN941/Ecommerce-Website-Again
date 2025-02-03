<?php
// Start session to manage session variables


// Database connection details
$servername = "localhost";
$username = "root";  // default for XAMPP
$password = "";      // default for XAMPP (empty password)
$dbname = "ecommerce";  // The database you're using (make sure this exists)

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
