<?php
session_start();
include('db.php'); // Include your database connection file

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the input values
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the SQL query to check if the user exists
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a user with the provided username exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password (assuming passwords are stored hashed in the database)
        if (password_verify($password, $user['password'])) {
            // Correct password, start a session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_role'] = $user['role']; // For role-based access

            // Redirect to user_dashboard.php
            header("Location: user_dashboard.php");
            exit();
        } else {
            // Incorrect password
            echo "Invalid password. Please try again.";
        }
    } else {
        // Username not found
        echo "No user found with that username.";
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>
