<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body{
        background: url(hotel1.jpg);
        background-repeat: none;
        background-size: cover;
        margin: 0;
        padding: 0;
    }
    .conatiner{
        width: 100%;
        height: 100vh; 
       
        
       
    }
    #Booking{
        width: 35%;
        height: 400px;
        /* border: 1px solid black; */
        margin-top: 100px;
        margin-left: 100px;
        /* padding: 20px; */
        /* background-color: gray; */
         background-color: #EFE5DC;
        border-radius: 10px;
        box-shadow: 0px 5px 10px 5px gray ;

      
        float: left;
    }
    #B{
            width: 55%;
            height: 400px;
            margin-left: 30px;
            text-align: center;
            color: whitesmoke;
            float: left;
            /* border: 1px solid black; */
            background-color:rgba(42, 53, 45, 0.6);
            /* box-shadow: 10px 10px 0px black; */
            /* text-shadow: 2px 2px 5px black; */

            margin-top: 100px;
            p{
                color: white;
            }
        }
    #Booking input[type=text]{
        width: 90%;
        height: 25px;
       /* margin-left: 10px; */
        color: black;

        margin-top: 10px;
       


    }
    #Booking label{
        font-size: 20px;
        color: black;
    }
    #bookingform{
      
    }
    .form-group{
        margin-top: 10px;
        .out{
            margin-left: 75px;
        }
       
    }
    #Check-out{
        margin-left: 60px;
        padding: 7px;
    }
    .form-group{
        span{
            margin: 35px;
        }
        input[id="rooms"]{
            padding: 5px;
            width: 25%;
            float: left;
            /* margin-left: 5px; */

        }
    }
    .form-group button{
        padding: 10px;
        margin-left: 20px;
        /* background-color: ; */
        margin-top: 20px;
        background-color: green;
        color: white;
        border: none;
        cursor: pointer;

    }
    #Booking h1{
        margin-left: 120px; 

    }
    .form-group{
        margin-left: 15px;
        label{
            font-size: 15px;
        }
        #in{
            padding: 8px;
        }
    }
    input{
        margin: 10px 0px;

    }
    input[id="Adults"]{
        margin-left: 60px;
        width: 20%;
        padding: 5px;


    }
    input[id="child"]{
        margin-left: 15px;
        width: 20%;
        padding: 5px;


    }
   

        #B h1 {
            font-size: 30px;
            font-weight: bold;
        }

        #B span {
            color: red;
        }
    
    
   
</style>
<body>
    <div class="conatiner">

        <div id =Booking >
 <h1> Book Your Stay</h1>
 <form id ="bookingform">
    <div class="form-group">
    <label for="">Search Destination </label><br>
    <input type="text" name ="" placeholder="Enter Your Name "> 
    </div>

<div class="form-group">
<label for="">Check-in Date</label> 
<span class="out"><label for="checkout">Check-Out Date</label></span><br>
<input type="date"id="in" required>
<input type="date" id="Check-out"  required>
</div> 

<div class="form-group">
    <label for="guests">Number of Rooms</label>
    <span class="adult"><label for="guest">Adults</label></span>
    <span class="childs"><label for="guest">Childrens</label></span><br>
    <input type="number" id="rooms" placeholder="No of Rooms">
    <input type="number" id="Adults" placeholder="No of Adults ">
    <input type="number" id="child" placeholder="No of childs">
</div>
<div class="form-group">
    <button type="submit">Check Avilability</button>
    </div>
 </form>
        </div>
        <div id="B">
            <h1>MAKE<span>YOUR <Style color="red"></Style></span><br>RESERVATION</h1>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae reiciendis eveniet sequi!
                Aut, eaque quaerat mollitia corrupti culpa laboriosam nesciunt ex explicabo minus officiis.
                Labore, sequi? Maiores non cupiditate quod.
            </p>
        </div>
    </div>
    
</body>
</html>