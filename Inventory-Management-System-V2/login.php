<!-- login.php -->
<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <!-- Add your CSS stylesheets here if needed -->
	<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Form styles */
        .form-container {
            max-width: 400px;
            padding: 20px;
            margin: 50px auto;
            background-color: #f2f2f2;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .form-container label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        .form-container input[type="text"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-container input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .form-container input[type="submit"]:hover {
            background-color: #45a049;
        }

        .form-container p {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }
    </style>
</head>
<body>
      <div class="form-container">
        <h2>Login</h2>
        <form action="login_user.php" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <input type="submit" value="Login">
        </form>
        <p>Don't have an account? <a href="registration.php">Register</a></p>
    </div>
</body>
</html>
