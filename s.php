<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="form-container">
    <h2>Signup Form</h2>
    <form action="signup_process.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="fullname" placeholder="Full Name" required><br>
        <input type="number" name="age" placeholder="Age" required><br>
        <select name="gender" required>
            <option value="" disabled selected>Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select><br>
        <input type="text" name="address" placeholder="Address" required><br>
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="file" name="profile_picture" accept="image/*"><br>
        <input type="submit" value="Signup">
    </form>
</div>

</body>
</html>
