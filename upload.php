<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $certNumber = $_POST['cert_number'];
    $certDate = $_POST['cert_date'];
    $address = $_POST['address'];

    $fileName = basename($_FILES["certificate"]["name"]);
    $targetFilePath = "uploads/" . $fileName;

    if (move_uploaded_file($_FILES["certificate"]["tmp_name"], $targetFilePath)) {
        $query = "INSERT INTO certificates (certificate_number, name, mobile_number, certificate_date, address, certificate_file) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssss", $certNumber, $name, $mobile, $certDate, $address, $fileName);

        if ($stmt->execute()) {
            $message = "Certificate uploaded successfully!";
        } else {
            $message = "Database error.";
        }
    } else {
        $message = "File upload failed.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Upload Certificate</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2 class="text-center">Upload Student Certificate</h2>
    <?php if (isset($message)) echo "<div class='alert alert-info'>$message</div>"; ?>
    <form method="POST" enctype="multipart/form-data" class="shadow p-4 bg-light">
        <div class="mb-3">
            <label class="form-label">Certificate Number</label>
            <input type="text" name="cert_number" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Student Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Mobile Number</label>
            <input type="text" name="mobile" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Certificate Date</label>
            <input type="date" name="cert_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Address</label>
            <textarea name="address" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Certificate File</label>
            <input type="file" name="certificate" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Upload</button>
        <a href="logout_admin.php" class="btn btn-danger">Logout</a>
    </form>
</body>
</html>
