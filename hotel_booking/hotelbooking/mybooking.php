<?php
$conn = new mysqli("localhost", "root", "", "hotel_booking");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch bookings
$sql = "SELECT hotels1.name, bookings.* FROM bookings 
        JOIN hotels1 ON bookings.hotel_id = hotels1.id 
        ORDER BY booking_date DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Bookings</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid black; text-align: center; }
        .cancel-btn { padding: 5px 10px; background: red; color: white; border: none; cursor: pointer; }
        .cancelled { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <h2>My Bookings</h2>
    <table>
        <tr>
            <th>Hotel Name</th>
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Rooms</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['checkin']; ?></td>
                <td><?php echo $row['checkout']; ?></td>
                <td><?php echo $row['rooms']; ?></td>
                <td>₹<?php echo $row['total_price']; ?></td>
                <td class="<?php echo $row['status'] == 'cancelled' ? 'cancelled' : ''; ?>">
                    <?php echo ucfirst($row['status']); ?>
                </td>
                <td>
                    <?php if ($row['status'] == 'confirmed'): ?>
                        <form method="POST" action="bookingcancell.php">
                            <input type="hidden" name="booking_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="cancel-btn">Cancel</button>
                        </form>
                    <?php else: ?>
                        <span>Cancelled</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
