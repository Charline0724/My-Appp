<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
    header("Location: l.php");
    exit();
}

// Include the database connection
include('db.php');

// Get the user's ID from the session
$user_id = $_SESSION['user_id'];

// Fetch user data from the database
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if user data is found
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    // Handle case where no user is found (optional)
    echo "User not found!";
    exit();
}

// Handle form submission and profile update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    // Retrieve updated data
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];

    // Handle profile picture update
    $profile_picture = $user['profile_picture']; // Default to existing picture
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        // Handle file upload
        $profile_picture = 'uploads/' . basename($_FILES['profile_picture']['name']);
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profile_picture);
    }

    // Update user data in the database
    $updateSql = "UPDATE users SET fullname = ?, email = ?, age = ?, gender = ?, address = ?, profile_picture = ? WHERE id = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("ssisssi", $fullname, $email, $age, $gender, $address, $profile_picture, $user_id);

    if ($stmt->execute()) {
        header("Location: home.php"); // Redirect after successful update
        exit();
    } else {
        $error = "Error updating profile.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Ride Smart, Ride Fair</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
        <h2>Edit Profile</h2>

        <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>

        <form action="edit_profile.php" method="POST" enctype="multipart/form-data">
            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" name="fullname" value="<?php echo htmlspecialchars($user['fullname']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($user['age']); ?>" required>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="Male" <?php if ($user['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                <option value="Female" <?php if ($user['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                <option value="Other" <?php if ($user['gender'] == 'Other') echo 'selected'; ?>>Other</option>
            </select>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($user['address']); ?>" required>

            <label for="profile_picture">Profile Picture:</label>
            <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
            <?php if (!empty($user['profile_picture'])): ?>
                <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profile Picture" width="100">
            <?php else: ?>
                <p>No profile picture set.</p>
            <?php endif; ?>

            <button type="submit" name="update" class="btn">Update Profile</button>
        </form>
    </div>
</body>
</html>
