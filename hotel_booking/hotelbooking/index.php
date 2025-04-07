<?php 
// Database Connection
$host = "localhost";
$user = "root"; 
$pass = ""; 
$db = "hotel_booking"; 

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert Data if Form is Submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $mobile_number = $_POST['mobile_number'];
    $room_type = $_POST['room_type'];
    $price = $_POST['price'];
    $hotel_name = $_POST['hotel_name'];
    $city = $_POST['city'];
    $transaction_id = uniqid('TXN_');

    $sql = "INSERT INTO booking_users (username, email, mobile_number, room_type, price, transaction_id, hotel_name, city) 
            VALUES ('$username', '$email', '$mobile_number', '$room_type', '$price', '$transaction_id', '$hotel_name', '$city')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Booking Confirmed! Transaction ID: $transaction_id'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fetch available rooms with hotel details

$roomsQuery = "SELECT rooms.*, hotels1.name AS hotel_name, hotels1.city 
               FROM rooms 
               JOIN hotels1 ON rooms.hotel_id = hotels1.id";
$roomsResult = $conn->query($roomsQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .room-container { display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; padding: 20px; }
        .room-card { width: 100%; background: #fff; border-radius: 10px; padding: 15px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);}
        .room-card img { width: 500px; height:500px; border-radius: 10px; background-size: cover;}
        .room-card h2 { margin: 10px; }
        .room-card p { color: red; font-weight: bold; }
        .book-btn { background: green; color: white; padding: 10px; border: none; cursor: pointer; border-radius: 5px; width: 100%; }
        .book-btn:hover { background: darkgreen; }
        .form-container { display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
                         background: white; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); }
        .form-container input, .form-container button { width: 100%; padding: 10px; margin: 10px 0; border-radius: 5px; }
        #about{
            /* border: 1px solid black; */
            width: 40%;
            margin-left: 700px;
            /* margin-top: -500px; */

        }
        #about{
            h2,p button{
                margin-top: -350px;
            }
        }
        #about{
            button{
                width: 30%;
            }
        }
    </style>
    <script>
        function openBookingForm(roomType, price, hotelName, city) {
            document.getElementById("room_type").value = roomType;
            document.getElementById("price").value = price;
            document.getElementById("hotel_name").value = hotelName;
            document.getElementById("city").value = city;
            document.getElementById("booking-form").style.display = "block";
        }

        function closeBookingForm() {
            document.getElementById("booking-form").style.display = "none";
        }
    </script>
</head>
<body>

    <h1 style="text-align:center;">Available Hotel Rooms</h1>
    <div class="room-container">
        <?php while ($row = $roomsResult->fetch_assoc()) { ?>
            <div class="room-card">
                <img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['room_type']; ?>">
                <div id="about">

                <h2><?php echo $row['room_type']; ?></h2>
                <h2><?php echo $row['city']; ?></h2>

                <p>₹<?php echo number_format($row['price'], 2); ?> per night</p>
                <button class="book-btn" onclick="openBookingForm('<?php echo $row['room_type']; ?>', '<?php echo $row['price']; ?>', '<?php echo $row['hotel_name']; ?>', '<?php echo $row['city']; ?>')">Book Now</button>
                </div>
            </div>
        <?php } ?>
    </div>

    <div id="booking-form" class="form-container">
        <form method="post">
            <input type="text" name="username" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <input type="text" name="mobile_number" placeholder="Your Mobile Number" required>
            <input type="hidden" name="room_type" id="room_type">
            <input type="hidden" name="price" id="price">
            <input type="hidden" name="hotel_name" id="hotel_name">
            <input type="hidden" name="city" id="city">
            <button type="submit">Confirm Booking</button>
            <button type="button" onclick="closeBookingForm()">Cancel</button>
        </form>
    </div>

</body>
</html>