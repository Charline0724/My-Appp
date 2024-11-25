<?php
// contact.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Ride Smart, Ride Fair</title>
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
            max-width: 1200px;
            margin: 40px auto;
            background-color: rgb(0 0 0 / 30%);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: #fff;
        }

        .contact-info {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            text-align: center;
            color: #fff;
        }

        .contact-info div {
            max-width: 300px;
        }

        .contact-info h3 {
            margin-bottom: 10px;
        }

        .contact-info a {
            color: #c8e6c9;
            text-decoration: none;
        }

        .contact-info a:hover {
            color: #fff;
        }

        .social-media {
            text-align: center;
            margin-top: 20px;
        }

        .social-media a {
            margin: 0 10px;
            color: #fff;
        }

        .social-media a:hover {
            color: #c8e6c9;
        }
    </style>
</head>
<body>
    <nav>
        <div>
            <a href="user_dashboard.php">Home</a>
            <a href="#services">Services</a>
            <a href="contact.php" title="Contact Us"><i class="fas fa-envelope"></i> Contact</a>
            <a href="reviews.php" title="Reviews"><i class="fas fa-star"></i> Reviews</a>
        </div>
    </nav>

    <section id="contact">
        <h2>Contact Us</h2>
        <div class="contact-info">
            <div>
                <h3><i class="fas fa-map-marker-alt"></i> Address</h3>
                <p>Mabini Pilar Surigao del norte</p>
            </div>
            <div>
                <h3><i class="fas fa-phone"></i> Phone</h3>
                <p>+63 912 345 6789</p>
                <p>+63 987 654 3210</p>
            </div>
            <div>
                <h3><i class="fas fa-envelope"></i> Email</h3>
                <p><a href="mailto:info@ridesiargao.com">info@ridesiargao.com</a></p>
                <p><a href="mailto:support@ridesiargao.com">support@ridesiargao.com</a></p>
            </div>
            <div>
                <h3><i class="fas fa-clock"></i> Operating Hours</h3>
                <p>Monday - Sunday: 8:00 AM - 6:00 PM</p>
            </div>
        </div>

        <div class="social-media">
            <h3>Follow Us</h3>
            <a href="https://facebook.com" target="_blank" title="Facebook"><i class="fab fa-facebook fa-2x"></i></a>
            <a href="https://instagram.com" target="_blank" title="Instagram"><i class="fab fa-instagram fa-2x"></i></a>
            <a href="https://twitter.com" target="_blank" title="Twitter"><i class="fab fa-twitter fa-2x"></i></a>
        </div>
    </section>
</body>
</html>
