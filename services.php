<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'Customer') {
    header("Location: login.html");
    exit();
}

require 'db_connection.php';

$query = "SELECT * FROM services";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Service | Avan Makeup Studio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Book a Makeup Service</h2>
        <div class="row">
            <?php while ($service = $result->fetch_assoc()): ?>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($service['name']); ?></h5>
                            <p class="card-text"><?= htmlspecialchars($service['description']); ?></p>
                            <p><strong>Price:</strong> ₹<?= number_format($service['price'], 2); ?></p>
                            <form action="book_service.php" method="POST">
                                <input type="hidden" name="service_id" value="<?= $service['id']; ?>">
                                <button type="submit" class="btn btn-primary">Book Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <a href="dashboard.php" class="btn btn-dark">Back to Dashboard</a>
    </div>
</body>
</html>
