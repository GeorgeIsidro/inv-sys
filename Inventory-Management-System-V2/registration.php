<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        .registration-form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 100px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .form-group button {
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            width: 100%;
        }
        .form-group button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="registration-form">
        <h2>Registration</h2>
        <form action="register_user.php" method="post">
            <div class="form-group">
                <label for="FName">First Name:</label>
                <input type="text" name="FName" required>
            </div>
            <div class="form-group">
                <label for="LName">Last Name:</label>
                <input type="text" name="LName" required>
            </div>
            <div class="form-group">
                <label for="UName">Username:</label>
                <input type="text" name="UName" required>
            </div>
            <div class="form-group">
                <label for="PWord">Password:</label>
                <input type="password" name="PWord" required>
            </div>
            <div class="form-group">
				<label for="user_role">User Role:</label>
					<select name="user_role" required>
						<option value="">Select a Role</option>
						<option value="teacher">Teacher</option>
						<option value="guest">Guest</option>
						<option value="other">Other</option>
					</select>
            </div>
            <div class="form-group">
                <button type="submit">Register</button>
            </div>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
