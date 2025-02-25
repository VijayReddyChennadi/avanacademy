<?php
session_start();
require 'db_connection.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'Customer') {
    header("Location: login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['service_id'])) {
    $customer_id = $_SESSION['user_id'];
    $service_id = intval($_POST['service_id']);

    $stmt = $conn->prepare("INSERT INTO bookings (customer_id, service_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $customer_id, $service_id);

    if ($stmt->execute()) {
        echo "<script>alert('Booking successful!'); window.location.href='services.php';</script>";
    } else {
        echo "<script>alert('Booking failed. Try again.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: services.php");
}
?>
