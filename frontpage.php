<?php
// You can include any necessary PHP logic here (e.g., authentication check, database connection, etc.)

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ride Smart, Ride Fair</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: url('./pictures/Siargao\ Travel\ Guide_\ -\ Our\ Travel\ Passport.jpg') no-repeat center center/cover;
            background-color: #f4f4f4; /* Fallback color */
            color: #000000; /* Dark blue-gray text */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            text-align: center;
        }
        .next-btn {
            padding: 10px 20px;
            font-size: 1rem;
            color: #fff;
            background-color: #000000; /* Green button */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .next-btn:hover {
            background-color: #219150; /* Darker green on hover */
        }
    </style>
</head>
<body>
    <div>
        <h1>Ride Smart, Ride Fair in Siargao</h1>
        <p>Explore Siargao with trusted rides, fair prices, and a sustainable future.</p>
        <button class="next-btn" onclick="goToNextPage()">Next</button>
    </div>

    <script>
        function goToNextPage() {
            // Redirect to the home page
            window.location.href = "l.php"; 
        }
    </script>
</body>
</html>
