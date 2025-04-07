<?php
$conn = new mysqli("localhost", "root", "", "hotel_booking");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if booking_id is received
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["booking_id"])) {
    $booking_id = $_POST["booking_id"];

    // Update booking status to "cancelled"
    $sql = "UPDATE bookings SET status = 'cancelled' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $booking_id);

    if ($stmt->execute()) {
        echo "<script>alert('Booking cancelled successfully!'); window.location='mybooking.php';</script>";
    } else {
        echo "<script>alert('Cancellation failed. Please try again.'); window.location='mybooking.php';</script>";
    }
}
?>
