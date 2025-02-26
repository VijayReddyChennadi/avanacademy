<?php
require 'logger.php';

$servername = "localhost";
$username = "u289603047_admin"; // Change as needed
$password = "Chennadi@Ally24"; // Change as needed
$dbname = "u289603047_avanacademy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    logError("Database connection failed: " . $conn->connect_error);
    die("Database connection error. Please try again later.");
}
?>
