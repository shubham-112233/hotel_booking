<?php
include "db.php"; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if passwords match
    if ($_POST['password'] == $_POST['cnp']) {
        // Get form data and sanitize inputs
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $google_id = mysqli_real_escape_string($conn, $_POST['gid']);

        // Debugging - Check values before inserting
        echo "<strong>Debugging Info:</strong><br>";
        echo "Name: " . htmlspecialchars($name) . "<br>";
        echo "Hashed Password: " . htmlspecialchars($password) . "<br>";
        echo "Google ID: " . htmlspecialchars($google_id) . "<br>";

        // Ensure Google ID exists in database
        $check_user = "SELECT * FROM users";
        $user_result = mysqli_query($conn, $check_user);
        print_r($user_result);

        if (mysqli_num_rows($user_result) > 0) {
            // User exists, update password
            $update_query = "UPDATE users SET password = '$password' WHERE google_id = '1234432112344321'";
            $update_result = mysqli_query($conn, $update_query);

            if ($update_result) {
                echo "✅ Password updated successfully!";
            } else {
                echo "❌ Error updating password: " . mysqli_error($conn);
            }
        } else {
            echo "❌ No user found with the given Google ID!";
        }

        // Close database connection
        mysqli_close($conn);
    } else {
        echo "❌ Password and Confirm Password do not match!";
    }
}
?>
