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
$hotel_id = $_GET['id']; 
$sql = "SELECT * FROM hotels1 WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $hotel_id);
$stmt->execute();
$result = $stmt->get_result();
$hotel = $result->fetch_assoc();

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
    <title><?php echo $hotel['name']; ?> - Hotel Details</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background-color: #f5f5f5;
        }
        .container { 
            width: 100%; 
            margin: 20px auto; 
            background: white; 
            padding: 20px; 
            border-radius: 10px; 
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .hotel-info {
            margin-bottom: 20px;
            /* border: 1px solid black; */
            width: 25%;
            /* margin-left: 850px;
            margin-top: -1100px; */
        }
        .hotel-info p {
            margin: 10px 0;
            font-size: 18px;
            /* border: 1px solid black; */
        }
        .book-btn {
            padding: 10px 20px;
            background-color: green;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }
        .book-btn:hover {
            background-color: darkgreen;
        }
        /* Added image styling only */
        .container img {
            width: 60%;
            height: 300px;
            object-fit: cover;
            display: block;
            margin: 10px 0;
        }
        #test2{
            width: 50%;
            height: 200px;
            background-color: gray;
        }
        .form-container{
            width: 100%;
            height: 400px;
            background-color: green;
            color: white;
            display: none;
        }
       
      
       
    </style>


</head>
<body>

<div class="container">
<?php while ($row = $roomsResult->fetch_assoc()) { ?>
    <img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['room_type']; ?>">
    <h2><?php echo $row['room_type']; ?></h2>
    <p>₹<?php echo number_format($row['price'], 2); ?> per night</p>
   
    <div class="hotel">
    <p><strong>City:</strong> <?php echo $hotel['city']; ?></p>
    <h1><?php echo $hotel['name']; ?></h1>
    <h2><?php echo $row['room_type']; ?></h2>
    <button class="book-btn" onclick="openForm('<?php echo $hotel['city']; ?>', '<?php echo $row['room_type']; ?>')">Book Now</button>

   
    
    </div>
   
<?php } ?>


</div>

<div id="booking-form" class="form-container">
        <form method="post">
            <input type="text" name="username" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <input type="text" name="mobile_number" placeholder="Your Mobile Number" required>
            <input type="hidden" name="room_type" id="room_type" >
            <input type="hidden" name="price" id="price">
            <input type="hidden" name="hotel_name" id="hotel_name">
            <input type="hidden" name="city" id="city">
            <button type="submit" onclick="comformbook()">Confirm Booking</button>
            <button type="button" onclick="closeBookingForm()">Cancel</button>
        </form>
    </div>


     

        

         
            
 






</body>

<script>
    //   var roomType;
  
     
      function openForm(roomType,city) {
        document.getElementById("room_type").value ;
        document.getElementById("city").value = city;
        console.log(roomType);
        console.log(city);
          
            document.getElementById("booking-form").style.display = "block";
            // alert(roomType+price+hotelName+city);
          
          
        }
        
  

        // console.log("roomtype:"+roomType+"here is price:"+price+"here is hotel name:"+hotelName+"here is you selected city:"+city);
        function closeBookingForm() {
            document.getElementById("booking-form").style.display = "none";
        }
        function comformbook(){
        

           var price= document.getElementsByTagName("input").value
           console.log(price);
        // var hotelName=  document.getElementById("hotel_name").value ;
            
            // console.log(price);
            // console.log(hotelName);
            
           

        }


</script>
</html>

<?php $conn->close(); 

?>