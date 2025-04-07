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

$hotels = [];
$error = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["city"])) {
    $city = trim($_POST["city"]);

    if (empty($city)) {
        $error = "Please enter a city name.";
    } else {
        $sql = "SELECT * FROM hotels1 WHERE city LIKE ?";
        $stmt = $conn->prepare($sql);
        $searchCity = "%$city%";
        $stmt->bind_param("s", $searchCity);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $hotels[] = $row;
        }

        if (empty($hotels)) {
            $error = "No hotels found in $city.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('hotel1.jpg') no-repeat center center/cover;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #Booking {
            width: 300px;
            padding: 20px;
            background-color: #EFE5DC;
            border-radius: 10px;
            box-shadow: 0px 5px 10px gray;
            text-align: center;
        }
        #Booking h1 {
            margin-bottom: 20px;
        }
        input[type="text"], input[type="date"], input[type="number"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid gray;
            border-radius: 5px;
        }
        button {
            padding: 10px 15px;
            background-color: green;
            color: white;
            border: none;
            cursor: pointer;
            margin-top: 10px;
        }
        #result {
            margin-top: 20px;
        }
        .hotel {
            background: white;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            box-shadow: 0 0 5px gray;
        }
        .not-found {
            color: red;
        }
        a{
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<body>

<div class="container">
    <div id="Booking">
        <h1>Book Your Stay</h1>
        <form method="POST" action="">
            <input type="text" name="city" id="city" placeholder="Enter City Name" required>
            <input type="date" name="checkin" id="checkin" required>
            <input type="date" name="checkout" id="checkout" required>
            <input type="number" name="rooms" id="rooms" placeholder="No of Rooms" min="1" required>

            <button type="submit">Check Availability</button>
        </form>
        <div id="result">
            <?php if (!empty($error)): ?>
                <p class="not-found"><?php echo $error; ?></p>
            <?php elseif (!empty($hotels)): ?>
                <?php foreach ($hotels as $hotel): ?>

     <a href="test.php?id=<?php echo $hotel['id']; ?>"> <div class="hotel">
        <img src="<?php echo $hotel['image_url']; ?>" alt="<?php echo $hotel['name']; ?>" style="width:100%; height:200px; border-radius:5px;">
      <h2><?php echo $hotel['name']; ?></h2> 
        <p><strong>City:</strong> <?php echo $hotel['city']; ?></p>
        <p><strong>Price:</strong> ₹<?php echo $hotel['price']; ?> per night</p>
        <p><strong>Rating:</strong> ⭐ <?php echo $hotel['rating']; ?>/5</p>
        <p><strong>Amenities:</strong> <?php echo $hotel['amenities']; ?></p>

        <form method="POST" action="book.php">
        <input type="hidden" name="hotel_id" value="<?php echo $hotel['id']; ?>">
            <input type="hidden" name="price" value="<?php echo $hotel['price']; ?>">
            <button type="submit">Book Now</button>
        </form>
    </div>
    </a>
<?php endforeach; ?>

            <?php endif; ?>       
 
                       
              
        </div>
    </div>
</div>

</body>
</html>