<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews - Ride Smart, Ride Fair</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
            background-color: rgb(255 255 255 / 0%);
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
            color: #c8e6c9;
        }

        nav a i {
            margin-right: 8px;
        }

        section {
            padding: 40px 20px;
            max-width: 800px;
            margin: 0 auto;
            background-color: rgb(0 0 0 / 50%);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        textarea, input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
        }

        textarea {
            height: 100px;
        }

        input[type="submit"] {
            background-color: #4582a0f2;
            color: #fff;
            font-size: 1rem;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #356b84;
        }

        .reviews {
            margin-top: 20px;
        }

        .review {
            background-color: rgb(255 255 255 / 80%);
            color: #333;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .review h4 {
            margin: 0 0 5px;
            color: #000;
        }

        .review p {
            margin: 0;
        }

        .star-rating {
            direction: rtl;
            font-size: 1.5rem;
            display: inline-block;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            color: #ddd;
            cursor: pointer;
        }

        .star-rating input:checked ~ label {
            color: #ffcc00;
        }

        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #ffcc00;
        }
    </style>
</head>
<body>
    <nav>
        <div>
            <a href="user_dashboard.php">Home</a>
            <a href="#services">Services</a>
            <a href="contact.php">Contact</a>
            <a href="reviews.php" title="Reviews"><i class="fas fa-star"></i> Reviews</a>
        </div>
    </nav>

    <section>
        <h2>Customer Reviews</h2>
        <p>We value your feedback! Please leave a review about your experience with us.</p>

        <form method="POST" action="reviews.php">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required placeholder="Enter your name">

            <label for="review">Your Review:</label>
            <textarea id="review" name="review" required placeholder="Write your review here..."></textarea>

            <label for="rating">Rating:</label>
            <div class="star-rating">
                <input type="radio" id="star5" name="rating" value="5"><label for="star5">&#9733;</label>
                <input type="radio" id="star4" name="rating" value="4"><label for="star4">&#9733;</label>
                <input type="radio" id="star3" name="rating" value="3"><label for="star3">&#9733;</label>
                <input type="radio" id="star2" name="rating" value="2"><label for="star2">&#9733;</label>
                <input type="radio" id="star1" name="rating" value="1"><label for="star1">&#9733;</label>
            </div>

            <input type="submit" value="Submit Review">
        </form>

        <div class="reviews">
            <?php
            // Basic PHP logic for handling reviews
            $file = 'reviews.txt'; // File to store reviews
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $name = htmlspecialchars($_POST['name']);
                $review = htmlspecialchars($_POST['review']);
                $rating = isset($_POST['rating']) ? $_POST['rating'] : 'No rating';
                $entry = "Name: $name\nReview: $review\nRating: $rating stars\n---\n";
                file_put_contents($file, $entry, FILE_APPEND);
            }

            if (file_exists($file)) {
                $reviews = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                $display = '';
                foreach ($reviews as $line) {
                    if (strpos($line, '---') === false) {
                        $display .= htmlspecialchars($line) . "<br>";
                    } else {
                        echo "<div class='review'>$display</div>";
                        $display = '';
                    }
                }
            }
            ?>
        </div>
    </section>
</body>
</html>
