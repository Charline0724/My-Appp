<?php
include('db.php'); // Include your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve submitted form data
    $fullname = $_POST['fullname'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Securely hash the password

    // Handle profile picture upload
    $profile_picture = null;
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $profile_picture = 'uploads/' . basename($_FILES['profile_picture']['name']);
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profile_picture);
    }

    // Insert the data into the database
    $sql = "INSERT INTO users (fullname, age, gender, address, username, password, profile_picture) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisssss", $fullname, $age, $gender, $address, $username, $password, $profile_picture);

    if ($stmt->execute()) {
        header("Location: l.php"); // Redirect to login page after successful signup
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
