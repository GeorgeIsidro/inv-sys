<!-- main_menu.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Main Menu</title>
    <style>
    .navbar {
        background-color: #333;
        overflow: hidden;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%; /* Make the navbar span the entire width */
    }

    /* Add some padding to the body to prevent content from being hidden under the navbar */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 50px 0 0 0; /* Adjust the top padding as needed */
    }
        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .navbar a.active {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a class="active" href="view-items.php">View Items</a>
        <a href="add_item.php">Add Item</a>
		<a href="view-requests.php">View Borrow Requests</a>
		<a href="login.php">Logout</a>
    </div>
</body>
</html>
