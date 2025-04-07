<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "hotel_booking";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create table if not exists
$conn->query("CREATE TABLE IF NOT EXISTS booking_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    mobile_number VARCHAR(15) NOT NULL
)");

// Fetch rooms from database
$sql = "SELECT * FROM rooms";
$result = $conn->query($sql);

// Handle booking submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["confirm_booking"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];

    $sql = "INSERT INTO booking_users (username, email, mobile_number) VALUES ('$username', '$email', '$mobile')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Your booking is confirmed!');</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}

// Get user details from URL
$username = isset($_GET['username']) ? $_GET['username'] : '';
$email = isset($_GET['email']) ? $_GET['email'] : '';
$mobile = isset($_GET['mobile']) ? $_GET['mobile'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; background-color: #f4f4f4; }
        .room-gallery { display: flex; flex-direction: column; gap: 20px; justify-content: center; align-items: center; margin-top: 20px; }
        .room-card { width: 80%; display: flex; align-items: center; background: #fff; border-radius: 10px; 
                     box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); overflow: hidden; padding: 10px; }
        .room-card img { width: 65%; height: 200px; object-fit: cover; border-radius: 10px; }
        .room-info { width: 35%; padding: 15px; text-align: left; }
        h3 { margin: 5px 0; font-size: 18px; }
        p { margin: 5px 0; font-size: 16px; color: #ff5733; font-weight: bold; }
        .book-btn { background: #28a745; color: white; padding: 10px; border: none; cursor: pointer; width: 100%; border-radius: 5px; }
        .book-btn:hover { background: #218838; }
        .booking-form { background: #fff; padding: 20px; width: 300px; margin: auto; border-radius: 10px; 
                        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); text-align: left; }
        input, button { display: block; width: 100%; margin: 10px 0; padding: 8px; }
        button { background: #007bff; color: white; border: none; cursor: pointer; border-radius: 5px; }
        button:hover { background: #0056b3; }
    </style>
</head>
<body>

    <h2>Available Hotel Rooms</h2>
    <div class="room-gallery">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="room-card">
                <img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['room_type']; ?>">
                <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                     Rem distinctio aut explicabo?
                      Voluptatibus repellat consectetur 
                      alias officiis enim voluptate nobis possimus odit 
                      impedit laudantium laborum, dolor deserunt accusamus explicabo.
                       Voluptates.</p> -->
                <div class="room-info">
                    <h3><?php echo $row['room_type']; ?></h3>
                    <p>₹<?php echo number_format($row['price'], 2); ?> per night</p>
                    <a href="test-index.php?username=John Doe&email=john@example.com&mobile=9876543210">
                        <button class="book-btn">Book Now</button>
                    </a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <?php if ($username && $email && $mobile): ?>
        <h2>Confirm Your Booking</h2>
        <div class="booking-form">
            <form action="test-index.php" method="POST">

                <label>Name:</label>
                <input type="text" name="username" value="<?php echo $username; ?>" required>

                <label>Email:</label>
                <input type="email" name="email" value="<?php echo $email; ?>" required>

                <label>Mobile Number:</label>
                <input type="text" name="mobile" value="<?php echo $mobile; ?>" required>

                <button type="submit" name="confirm_booking">Confirm Booking</button>
            </form>
        </div>
    <?php endif; ?>

</body>
</html>
