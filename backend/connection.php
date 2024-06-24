<?php
// Database credentials
// $hostname = 'localhost';    // Replace with your MySQL host name
// $db_username = 'root';      // Replace with your MySQL username
// $db_password = '';          // Replace with your MySQL password
// $database = 'real_estate';  // Replace with your MySQL database name


$hostname = 'localhost';             // Replace with your MySQL host name
$db_username = 'u519688753_real_estate';  // Replace with your MySQL username
$db_password = 'Deepak@987654321';      // Replace with your MySQL password
$database = 'u519688753_real_estate';  // Replace with your MySQL database name
// Create connection
$conn = new mysqli($hostname, $db_username, $db_password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
