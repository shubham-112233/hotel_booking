<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.html");
    exit();
}

$user = $_SESSION['user'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .container {
            width: 50%;
            height: 300px;
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <div class="container">
       <form action="updateU.php" method="POST">

       <label for="">Name:</label><br>
        <input type="text" name="name" value=" <?php echo ($user['name']) ?>" placeholder=""><br>
        <label for="">Enter Password</label><br>
        <input type="password" name="password" placeholder="Enter a new Password"><br>
        <label for="">Conform Password</label><br>
        <input type="password" name="cnp" placeholder="Conform the password"><br> <br>
        <input type="text" name="gid" value=" <?php echo ($user['google_id']) ?>"><br>
        <button>submit</button><br>
       </form>









    </div>


</body>

</html>