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

// Decode JSON images
$images = json_decode($hotel['image_url'], true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $hotel['name']; ?> - Hotel Details</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f5f5f5;cursor: pointer; }
        .container { width: 80%; margin: 20px auto; background: white; padding: 20px; border-radius: 10px; }
        .hotel-header { display: flex; gap: 20px; }
        .hotel-info { flex: 1; }
        .images { display: flex; gap: 10px; margin-top: 20px; }
        .images img { width: 150px; height: 100px; object-fit: cover; border-radius: 10px; }
        .images img:nth-child(1){
            width: 40%;
            height: 310px;

        }
        .images img:nth-child(2){
            width:250px;
            height: 150px;
            margin-left: 50px;
            /* border: 1px solid black; */

        }
        .images img:nth-child(3){
            width:250px;
            height: 150px;
            margin-top: 170px;
            margin-left: -260px;
         

        }
        /* p{
            
            
        } */
       #test{
        width: 300px;
        height: 350px;
            border: 1px gray;
            margin-left: 780px;
            margin-top: -320px;
           /* white-space: 10px; */
        }
        li{
            list-style: none;
            border: 1px solid yellow;
            width: 160px;
            border-radius: 5px;
            /* height: 30px; */
            padding: 7px;
            margin: 5px;

        }
        p{
            margin-left: 20px;
            /* text-align: center; */

        }
        .about{
            /* border: 1px solid black; */
            margin-top: -20px;

        }
        .about li{
            list-style: none;
            border: 1px solid black;
            float: left;
            margin: 10px;
            background-color:rgb(181, 225, 235,0.4);
        }
       i{
       
        color: blue;
       }
       .list li{
        border: none;
        float: left;
        /* border: 1px solid black; */
        
       }
      
       h3{
        margin-top: 100px;
       }
       .list i{
        /* background-color: black; */
        color: black;
       }
       a button{
        padding: 10px;
        background-color: green;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
       }
       .images img:nth-child(1) {
    width: 40%;
    height: 310px;
    max-width: 100%;
    object-fit: cover; 
}

@media screen and (max-width: 1024px) {
    .room-card {
        width: 45%;
    }
}

@media screen and (max-width: 768px) {
    .container {
        width: 95%;
    }
    
    .images {
        width: 100%;
        


       
    }
    .images img:nth-child(1){
        width: 90%;
        height: 300px;

    }
    .images img:nth-child(3){
        /* padding: 10px; */
        width: 85%;
        /* margin-left: 2px; */
        /* height: 300px; */

    }
    #btn{
        /* background-color: red; */
        margin-top: 90px;
       

    }
    /* .images img:nth-child(2){
        width: 45%;
        height: 300px;

    } */
   

    .booking-form {
        width: 90%;
    }
}

@media screen and (max-width: 480px) {
    .header {
        font-size: 20px;
        padding: 10px;
    }
    
    /* .room-card {
        width: 100%;
    } */
    
    .book-btn {
        font-size: 14px;
        
    }
    
}


    </style>
    <script src="https://kit.fontawesome.com/3a07f06365.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="container">
<h1><?php echo $hotel['name']; ?></h1>


    <div class="images">
        <!-- <?php foreach ($images as $img): ?> -->
            <img src="<?php echo $img; ?>" alt="Hotel Image">
        <!-- <?php endforeach; ?> -->
    </div>
    
    <div id="test">
        <li>super package</li>
        
    <p><strong>City:</strong> <?php echo $hotel['city']; ?></p>
    <p><strong>Price:</strong> ₹<?php echo number_format($hotel['price'], 2); ?></p>
    <p><strong>Amenities:</strong> <?php echo $hotel['amenities']; ?></p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus reprehenderit amet rem dolor repellendus. 
        Fugiat ipsam maxime nam, enim non fuga inventore repudiandae dolores suscipit, 
        qui quia, dolorem voluptas. Pariatur!</p>
    </div>
    <div class="about">
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
            Ducimus ipsam et nulla. Amet temporibus libero numquam repellat nulla ratione doloribus ab quasi,
             ducimus consequatur deleniti suscipit explicabo? Similique, 
             voluptates molestias!</p>
             <li><i class="fa-solid fa-spoon"></i>&nbsp; &nbsp;  food and Dining</li>
             
             <li><i class="fa-solid fa-location-dot"></i> &nbsp; &nbsp; Location</li>
            </div>

            <h3>Amenities</h3>
            <div class="list">
        
             <li><i class="fa-solid fa-spa"></i>&nbsp; &nbsp;  spa</li>
             <li><i class="fa-solid fa-person-swimming"></i>&nbsp;Swiming </li>
             <li>Gym</li>
             <li>Water Sports</li>
             <li>Beach Club</li>
             <li>Kids Play Area</li>
        <a href="test-index.php?id=<?php echo $hotel['id']; ?>"><button id="btn" onclick="">Select now</button></a>
            </div>
               
   
</div>

</body>
</html>

<?php $conn->close(); ?> 