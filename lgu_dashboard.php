<?php
session_start();

// Check if the user is logged in and has 'lgu' role
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'lgu') {
    header("Location: l.php"); // Redirect to login if not logged in or not LGU
    exit();
}

// Database connection
include('db.php');

// Fetch user data from the database (example)
$user_id = $_SESSION['user_id'];
$sql = "SELECT username, email FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user_data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LGU Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        header {
            background-color: #217891;
            color: #fff;
            padding: 15px;
            text-align: center;
        }
        nav {
            background-color: #4caf50;
            padding: 10px;
            text-align: center;
        }
        nav a {
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 1.1rem;
            margin: 0 10px;
        }
        nav a:hover {
            background-color: #45a049;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        footer {
            text-align: center;
            padding: 10px;
            background-color: #217891;
            color: white;
        }
        .dashboard-card {
            background-color: #fff;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .dashboard-card h3 {
            margin-top: 0;
        }
    </style>
</head>
<body>

<header>
    <h1>Welcome to the LGU Dashboard</h1>
</header>

<nav>
    <a href="lgu_dashboard.php">Home</a>
    <a href="user_list.php">User List</a>
    <a href="reports.php">Reports</a>
    <a href="settings.php">Settings</a>
    <a href="logout.php">Logout</a>
</nav>

<div class="content">
    <div class="dashboard-card">
        <h3>Welcome, <?php echo htmlspecialchars($user_data['username']); ?>!</h3>
        <p>Email: <?php echo htmlspecialchars($user_data['email']); ?></p>
        <p>You are logged in as an LGU user.</p>
    </div>

    <div class="dashboard-card">
        <h3>Recent Activities</h3>
        <ul>
            <li>Review recent community check-ups</li>
            <li>Monitor service requests</li>
            <li>Update records</li>
        </ul>
    </div>
</div>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Your Organization. All Rights Reserved.</p>
</footer>

</body>
</html>
