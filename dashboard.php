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
            <?php
            $customer_id = $_SESSION['user_id'];
            $bookingQuery = "SELECT b.*, s.name AS service_name FROM bookings b
                             JOIN services s ON b.service_id = s.id
                             WHERE b.customer_id = ?";
            $stmt = $conn->prepare($bookingQuery);
            $stmt->bind_param("i", $customer_id);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($booking = $result->fetch_assoc()):
            ?>
                <tr>
                    <td><?= htmlspecialchars($booking['service_name']); ?></td>
                    <td><?= $booking['booking_date']; ?></td>
                    <td><?= $booking['status']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php endif; ?>
