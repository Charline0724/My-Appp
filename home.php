<?php
session_start();
include('db.php'); // Include your database connection file

// Check if the user is logged in and has 'lgu' role
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'lgu') {
    header("Location: l.php"); // Redirect to login if not logged in or not LGU
    exit();
}

// Handle form submission for adding new transport services
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $service_name = $_POST['service_name'];
    $description = $_POST['description'];
    $price_details = $_POST['price_details'];

    // Insert data into the database
    $sql = "INSERT INTO transport_services (service_name, description, price_details) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $service_name, $description, $price_details);

    if ($stmt->execute()) {
        echo "New transport service added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Fetch transport services from the database
$sql = "SELECT * FROM transport_services";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ride Smart, Ride Fair</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Font Awesome link -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            background: url('./pictures/Guyam\,\ Siargao\ Island\,\ Philippines….jpg') no-repeat center center/cover;
            background-attachment: fixed;
            color: #fff;
        }

        nav {
            background-color: rgb(255 255 255 / 0%); /* Semi-transparent green */
            color: #fff;
            padding: 10px 20px;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        nav div {
            display: flex;
            justify-content: space-around;
        }

        nav a {
            text-decoration: none;
            color: #fff;
            font-size: 1.1rem;
            padding: 5px 10px;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #c8e6c9; /* Light green on hover */
        }

        nav a i {
            margin-right: 8px; /* Space between icon and text */
        }

        section {
            padding: 40px 20px;
            max-width: 1200px;
            margin: 0 auto;
            background-color: rgb(0 0 0 / 30%); /* Semi-transparent black for readability */
            border-radius: 8px;
        }

        #about {
            text-align: center;
        }

        #services {
            margin-top: 20px;
        }

        .features {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .feature-card {
            background-color: rgb(255 255 255 / 62%); /* Semi-transparent white for readability */
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgb(0 0 0 / 40%);
            max-width: 300px;
            text-align: center;
            overflow: hidden;
        }

        .feature-card img {
            width: 100%;
            height: auto;
            border-bottom: 1px solid #ddd;
        }

        .feature-card h3 {
            font-size: 1.2rem;
            margin: 10px 0;
            color: #141515;
        }

        .feature-card p {
            padding: 0 10px 20px;
            color: #1a1818;
            font-size: 0.95rem;
        }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <nav>
        <div>
            <a href="#about">About</a>
            <a href="#services">Services</a>
            <a href="location.php">GPS Location</a>
            <a href="contact.php">Contact</a>
            
            <!-- Icons with links -->
            <a href="edit_profile.php" title="Profile"><i class="fas fa-user"></i> Profile</a>
            <a href="reviews.php" title="Review"><i class="fas fa-star"></i> Reviews</a>
            <a href="logout.php" title="Logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </nav>

    <section id="about">
        <h2>Welcome to Ride Smart, Ride Fair in Siargao</h2>
        <p>
            We are your trusted partner for transportation in Siargao. Whether you need to get to the beaches, lagoons, or local markets, we ensure fair pricing and reliable rides. Let's make your journey memorable and sustainable.
        </p>
    </section>

    <section id="services">
        <h2>Our Services</h2>
        <div class="features">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="feature-card">
                        <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['service_name']); ?>">
                        <h3><?php echo htmlspecialchars($row['service_name']); ?></h3>
                        <p><?php echo htmlspecialchars($row['description']); ?></p>
                        <p><?php echo htmlspecialchars($row['price_details']); ?></p>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No services available at the moment.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Form to Add New Transport Service -->
    <section id="add-service">
        <h2>Add New Transport Service</h2>
        <div class="form-container">
            <form method="POST" action="">
                <label for="service_name">Service Name:</label><br>
                <input type="text" id="service_name" name="service_name" required><br>

                <label for="description">Description:</label><br>
                <textarea id="description" name="description" rows="4" required></textarea><br>

                <label for="price_details">Price Details:</label><br>
                <textarea id="price_details" name="price_details" rows="4" required></textarea><br>

                <button type="submit">Add Service</button>
            </form>
        </div>
    </section>
</body>
</html>
