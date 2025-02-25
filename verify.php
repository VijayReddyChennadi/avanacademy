<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Verify Certificate | Avan Makeup Academy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
    <h2 class="text-center">Certificate Verification</h2>
    <p class="text-center">
        Welcome to Avan Makeup Studio and Academy's Certificate Verification page. Here, you can verify the authenticity of a certificate issued by our academy by entering the certificate number or the student's registered mobile number.
    </p>
    <form method="POST" class="shadow p-4 bg-light">
        <div class="mb-3">
            <label class="form-label">Certificate Number or Mobile Number</label>
            <input type="text" name="search_value" class="form-control" placeholder="Enter Certificate Number or Mobile Number" required>
        </div>
        <button type="submit" class="btn btn-primary">Verify</button>
    </form>
    <!-- Result display section -->
    <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $searchValue = $_POST['search_value'];
                $query = "SELECT * FROM certificates WHERE certificate_number = ? OR mobile_number = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ss", $searchValue, $searchValue);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<div class='mt-4 p-3 border rounded bg-white'>";
                    echo "<p><strong>Name:</strong> " . $row['name'] . "</p>";
                    echo "<p><strong>Certificate Date:</strong> " . $row['certificate_date'] . "</p>";
                    echo "<a href='download.php?cert=" . $row['certificate_number'] . "' class='btn btn-success'>Download Certificate</a>";
                    echo "</div>";
                } else {
                    echo "<p class='text-danger mt-3'>No certificate found.</p>";
                }
            }
            ?>
        </div>
    
</body>
</html>
