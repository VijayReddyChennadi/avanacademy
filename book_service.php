<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'Customer') {
    header("Location: login.html");
    exit();
}

require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['service_id'])) {
    $customer_id = $_SESSION['user_id'];
    $service_id = $_POST['service_id'];

    $insertBooking = "INSERT INTO bookings (customer_id, service_id) VALUES (?, ?)";
    $stmt = $conn->prepare($insertBooking);
    $stmt->bind_param("ii", $customer_id, $service_id);

    if ($stmt->execute()) {
        header("Location: dashboard.php?message=Booking successful");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
