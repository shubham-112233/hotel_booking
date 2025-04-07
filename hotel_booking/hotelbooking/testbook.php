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

// Fetch hotel data
$hotel = null;
$rooms = [];
$error = "";
$successMessage = "";

if (isset($_GET['id'])) {
    $hotel_id = $_GET['id'];

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

    // Fetch rooms for the hotel
    $roomSQL = "SELECT * FROM rooms WHERE hotel_id = ?";
    $stmt = $conn->prepare($roomSQL);
    $stmt->bind_param("i", $hotel_id);
    $stmt->execute();
    $rooms = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

// Handle booking submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_name'])) {
    $user_name = trim($_POST['user_name']);
    $user_email = trim($_POST['user_email']);
    $user_phone = trim($_POST['user_phone']);
    $room_id = $_POST['room_id'];

    if (empty($user_name) || empty($user_email) || empty($user_phone) || empty($room_id)) {
        $error = "Please fill all details and select a room.";
    } else {
        // Fetch room details
        $roomSQL = "SELECT * FROM rooms WHERE id = ?";
        $stmt = $conn->prepare($roomSQL);
        $stmt->bind_param("i", $room_id);
        $stmt->execute();
        $room = $stmt->get_result()->fetch_assoc();

        $insertSQL = "INSERT INTO bookings (hotel_id, room_id, user_name, user_email, user_phone, price, room_type) 
                      VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertSQL);
        $stmt->bind_param("iisssis", $hotel_id, $room_id, $user_name, $user_email, $user_phone, $room['price'], $room['room_type']);

        if ($stmt->execute()) {
            $successMessage = "🎉 Booking Confirmed! Your " . $room['room_type'] . " has been booked!";
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
            width: 400px;
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
        .room-options {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }
        .room {
            width: 45%;
            cursor: pointer;
            border: 2px solid gray;
            border-radius: 5px;
            padding: 10px;
            text-align: center;
        }
        .room.selected {
            border-color: green;
            background-color: rgba(0, 255, 0, 0.2);
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
    <script>
        function selectRoom(roomId, price, type) {
            document.getElementById("room_id").value = roomId;
            document.getElementById("price").value = price;
            document.querySelectorAll('.room').forEach(room => room.classList.remove('selected'));
            document.getElementById("room_" + roomId).classList.add('selected');
        }
    </script>
</head>
<body>

<div class="container">
    <?php if ($hotel): ?>
        <h2><?php echo htmlspecialchars($hotel['name']); ?></h2>
        <img src="<?php echo htmlspecialchars($hotel['image_url']); ?>" alt="<?php echo htmlspecialchars($hotel['name']); ?>">
        <p><strong>City:</strong> <?php echo htmlspecialchars($hotel['city']); ?></p>

        <h3>Select a Room Type</h3>
        <div class="room-options">
            <?php foreach ($rooms as $room): ?>
                <div class="room" id="room_<?php echo $room['id']; ?>" onclick="selectRoom(<?php echo $room['id']; ?>, <?php echo $room['price']; ?>, '<?php echo $room['room_type']; ?>')">
                    <img src="<?php echo htmlspecialchars($room['image_url']); ?>" alt="<?php echo $room['room_type']; ?>" width="100%">
                    <p><strong><?php echo $room['room_type']; ?></strong></p>
                    <p>₹<?php echo $room['price']; ?> per night</p>
                </div>
            <?php endforeach; ?>
        </div>

        <h3>Enter Your Details</h3>
        <form method="POST">
            <input type="hidden" name="hotel_id" value="<?php echo $hotel['id']; ?>">
            <input type="hidden" id="room_id" name="room_id" required>
            <input type="hidden" id="price" name="price">

            <input type="text" name="user_name" placeholder="Enter Your Name" required>
            <input type="email" name="user_email" placeholder="Enter Your Email" required>
            <input type="text" name="user_phone" placeholder="Enter Your Phone Number" required>

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
