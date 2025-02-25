<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}
$user_role = $_SESSION['user_role'];
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
            <p>Explore and book makeup services.</p>
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
