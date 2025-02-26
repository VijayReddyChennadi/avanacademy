<?php
session_start();
require 'logger.php';
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    logError("Unauthorized access to test dashboard.php");
    header("Location: login.html");
    exit();
}

$user_role = $_SESSION['user_role'];
$customer_id = $_SESSION['user_id'];

$bookingQuery = "SELECT b.*, s.name AS service_name FROM bookings b
                 JOIN services s ON b.service_id = s.id
                 WHERE b.customer_id = ?";
$stmt = $conn->prepare($bookingQuery);
if (!$stmt) {
    logError("SQL Prepare failed in dashboard.php: " . $conn->error);
    die("An error occurred. Please try again later.");
}

$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Avan Makeup Studio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Welcome to Dashboard</h2>
        <?php if ($user_role == 'Customer'): ?>
            <h3>My Bookings</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($booking = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($booking['service_name']); ?></td>
                            <td><?= $booking['booking_date']; ?></td>
                            <td><?= $booking['status']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <a href="services.php" class="btn btn-primary">Book a Service</a>
        <?php elseif ($user_role == 'Artist'): ?>
            <p>Manage your portfolio and service offerings.</p>
        <?php elseif ($user_role == 'Student'): ?>
            <p>Enroll in courses and make payments.</p>
        <?php elseif ($user_role == 'Admin'): ?>
            <p>Manage users, services, courses, and reports.</p>
        <?php elseif ($user_role == 'Manager'): ?>
            <p>Review reports and details (restricted access).</p>
        <?php endif; ?>
        <a href="logout.php" class="btn btn-dark">Logout</a>
    </div>
</body>
</html>