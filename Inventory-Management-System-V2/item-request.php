<?php
// Include the database connection file
include_once "db_connect.php";

// Initialize variables to hold form data and notifications
$itemToRequest = $quantity = $purpose = $dateNeeded = "";
$notification = "";
$errorMsg = "";

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemToRequest = $_POST['item_request'];
    $quantity = $_POST['quantity'];
    $purpose = $_POST['purpose'];
    $dateNeeded = $_POST['date_needed'];

    // Validate and insert data into the database
    if (!empty($itemToRequest) && !empty($quantity) && !empty($purpose) && !empty($dateNeeded)) {
        $stmt = $conn->prepare("INSERT INTO borrow_requests (item_request, quantity, purpose, date_needed) VALUES (?, ?, ?, ?)");
        $stmt->execute([$itemToRequest, $quantity, $purpose, $dateNeeded]);

        // Display a success notification
        $notification = "Item request sent successfully!";
    } else {
        // Display an error message
        $errorMsg = "Please fill in all the required fields.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Item Request Form</title>
    <!-- Add your CSS stylesheets here if needed -->
    <style>
	body {
      font-family: Arial, sans-serif;
      background-color: #e1f5e1;
      color: #006400;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    form {
      max-width: 400px;
      margin: 0 auto;
      background-color: #f0fff0;
      padding: 20px;
      border-radius: 5px;
    }

    label {
      display: block;
      font-size: 16px;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="number"],
    select,
    input[type="date"] {
      width: 100%;
      padding: 8px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 4px;
      margin-bottom: 10px;
      box-sizing: border-box; /* Add this to include padding and border in width calculation */
    }

    input[type="submit"] {
      background-color: #006400;
      color: #fff;
      padding: 8px 12px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #004d00;
    }

    a {
      display: block;
      text-align: center;
      color: #006400;
      margin-top: 10px;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }
	
    /* Your CSS styles */
    /* ... */
    .notification {
        color: green;
        margin-bottom: 10px;
    }
    .error-message {
        color: red;
        margin-bottom: 10px;
    }
	.button {
    display: inline-block;
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    font-size: 16px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
	}

.button:hover {
    background-color: #45a049;
	}
    </style>
</head>
<body>
    <h2>Item Request Form</h2>
    <?php
    // Display the success notification or error message if set
    if (!empty($notification)) {
        echo '<p class="notification">' . $notification . '</p>';
    }
    if (!empty($errorMsg)) {
        echo '<p class="error-message">' . $errorMsg . '</p>';
    }
    ?>
    <form action="item-request.php" method="post">
        <label for="item_request">Item to be Requested/Borrowed:</label>
        <input type="text" name="item_request" required><br>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" required><br>

        <label for="purpose">Purpose:</label>
        <textarea name="purpose" rows="4" required></textarea><br>

        <label for="date_needed">Date Needed:</label>
        <input type="date" name="date_needed" required><br>

        <input type="submit" value="Submit"> <br>
		<a href="view-items-guest.php" class="button">Back</a>
	</form>
</body>
</html>
