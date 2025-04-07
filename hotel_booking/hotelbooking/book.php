<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "hotel_booking";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$hotel = null;
$error = "";
$successMessage = "";

// Get hotel details using hotel_id
if (isset($_POST['hotel_id'])) {
    $hotel_id = $_POST['hotel_id'];

    $sql = "SELECT * FROM hotels1 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $hotel_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $hotel = $result->fetch_assoc();
    } else {
        $error = "Hotel not found!";
    }
}

// Handle booking submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_name'])) {
    $user_name = trim($_POST['user_name']);
    $user_email = trim($_POST['user_email']);
    $user_phone = trim($_POST['user_phone']);
    $hotel_id = $_POST['hotel_id'];
    $price = $_POST['price'];
    $room_type = $_POST['room_type'];  // New Room Type field

    if (empty($user_name) || empty($user_email) || empty($user_phone) || empty($room_type)) {
        $error = "Please fill all details.";
    } else {
        $insertSQL = "INSERT INTO bookings (hotel_id, user_name, user_email, user_phone, price, room_type) 
                      VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertSQL);
        $stmt->bind_param("isssis", $hotel_id, $user_name, $user_email, $user_phone, $price, $room_type);

        if ($stmt->execute()) {
            $successMessage = "🎉 Booking Confirmed! Your $room_type room has been booked. Check your email for details.";
        } else {
            $error = "Error in booking.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('hotel1.jpg') no-repeat center center/cover;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 350px;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 5px 10px gray;
            text-align: center;
        }
        img {
            width: 100%;
            height: 200px;
            border-radius: 5px;
        }
        input, select, button {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }
        button {
            background-color: green;
            color: white;
            border: none;
            cursor: pointer;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>

<div class="container">
    <?php if ($hotel): ?>
        <h2><?php echo $hotel['name']; ?></h2>
        <img src="<?php echo $hotel['image_url']; ?>" alt="<?php echo $hotel['name']; ?>">
        <p><strong>City:</strong> <?php echo $hotel['city']; ?></p>
        <p><strong>Price:</strong> ₹<?php echo $hotel['price']; ?> per night</p>
        <p><strong>Rating:</strong> ⭐ <?php echo $hotel['rating']; ?>/5</p>
        <p><strong>Amenities:</strong> <?php echo $hotel['amenities']; ?></p>

        <h3>Enter Your Details</h3>
        <form method="POST">
            <input type="hidden" name="hotel_id" value="<?php echo $hotel['id']; ?>">
            <input type="hidden" name="price" value="<?php echo $hotel['price']; ?>">

            <input type="text" name="user_name" placeholder="Enter Your Name" required>
            <input type="email" name="user_email" placeholder="Enter Your Email" required>
            <input type="text" name="user_phone" placeholder="Enter Your Phone Number" required>
            
            <!-- New Room Type Selection -->
            <select name="room_type" required>
                <option value="">Select Room Type</option>
                <option value="AC">AC Room</option>
                <option value="Non-AC">Non-AC Room</option>
            </select>

            <button type="submit">Confirm Booking</button>
        </form>

        <?php if (!empty($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php elseif (!empty($successMessage)): ?>
            <p class="success"><?php echo $successMessage; ?></p>
        <?php endif; ?>
    <?php else: ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
</div>

</body>
</html>
