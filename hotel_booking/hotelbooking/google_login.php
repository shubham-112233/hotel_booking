<?php
session_start();
include "db.php";

if (!isset($_POST['credential'])) {
    die("Invalid request");
}

$token = $_POST['credential'];
$google_data = json_decode(base64_decode(explode('.', $token)[1]), true);

$email = $google_data['email'];
$name = $google_data['name'];
$google_id = $google_data['sub'];

// Check if user exists
$query = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    // Insert new user if not found
    $query = "INSERT INTO users (name, email, google_id) VALUES ('$name', '$email', '$google_id')";
    $conn->query($query);
    $user = ["name" => $name, "email" => $email,"google_id"=>$google_id];
}

// Store user data in session
$_SESSION['user'] = $user;

// Redirect to dashboard
header("Location: updateusers.php");
exit();
?>
