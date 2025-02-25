<?php
require 'logger.php';

$servername = "localhost";
$username = "your_db_user";
$password = "your_db_password";
$dbname = "your_database_name";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    logError("Database connection failed: " . $conn->connect_error);
    die("Database connection error. Please try again later.");
}
?>
