<?php
require 'logger.php';

$servername = "localhost";
$username = "root"; // Change as needed
$password = ""; // Change as needed
$dbname = "avan_makeup_academy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    logError("Database connection failed: " . $conn->connect_error);
    die("Database connection error. Please try again later.");
}
?>
