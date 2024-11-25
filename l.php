<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: url('./pictures/Guyam\,\ Siargao\ Island\,\ Philippines….jpg') no-repeat center center/cover;
            background-color: #f4f4f4; /* Fallback color */
            color: #217891ba;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #fff;
        }

        form {
            background-color: rgb(61 159 155 / 50%); /* Semi-transparent white background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 350px;
            text-align: center;
        }

        input[type="text"], input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            background-color: #217891a3; /* Green button */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #17663c; /* Darker green on hover */
        }

        .signup-link {
            margin-top: 20px;
            text-align: center;
        }

        .signup-link button {
            background-color: #217891bf;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .signup-link button:hover {
            background-color: #219150;
        }

        /* Responsive design */
        @media (max-width: 600px) {
            h2 {
                font-size: 1.5rem;
            }

            form {
                padding: 15px;
                max-width: 300px;
            }

            input[type="text"], input[type="password"], input[type="submit"] {
                font-size: 0.9rem;
            }

            .signup-link button {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <h2>Login</h2>
    <form action="login_process.php" method="POST">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Login">
    </form>
    <div class="signup-link">
        <!-- Sign Up button/link -->
        <a href="s.php"><button>Sign Up</button></a>
    </div>
</body>
</html>
