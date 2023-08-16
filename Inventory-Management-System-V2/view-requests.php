<?php
// Include the database connection file
include_once "db_connect.php";

session_start();

// Fetch all item requests from the database
$stmt = $conn->query("SELECT * FROM borrow_requests ORDER BY date_needed DESC");
$itemRequests = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Process actions (Confirm, Edit, Returned)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['confirm'])) {
        $requestId = $_POST['request_id'];
        $itemRequest = $conn->query("SELECT * FROM borrow_requests WHERE id = $requestId")->fetch(PDO::FETCH_ASSOC);
        
        // Check if there is enough quantity available
        $propertyNumber = $itemRequest['property_number'];
        $requestedQuantity = $itemRequest['quantity']; // Get the requested quantity

        $availableQuantity = $conn->query("SELECT quantity_bought FROM inventory WHERE property_number = '{$propertyNumber}'")->fetchColumn();
        
        if ($availableQuantity >= $requestedQuantity) { // Check if available quantity is greater or equal to requested quantity
            // Update designation
            $updateStmt = $conn->prepare("UPDATE inventory SET designation = 'Borrowed' WHERE property_number = ?");
            $updateStmt->execute([$propertyNumber]);
            
            // Update quantity_bought by subtracting requested quantity
            $updateQtyStmt = $conn->prepare("UPDATE inventory SET quantity_bought = quantity_bought - ? WHERE property_number = ?");
            $updateQtyStmt->execute([$requestedQuantity, $propertyNumber]);
        } else {
            // Display an error notification if quantity is not available
            $notification = "Insufficient quantity available for borrowing.";
        }
    } elseif (isset($_POST['edit'])) {
        $requestId = $_POST['request_id'];
        
        // Redirect to edit page with request ID
        header("Location: edit_request.php?request_id=$requestId");
        exit();
    } elseif (isset($_POST['returned'])) {
        $requestId = $_POST['request_id'];
        $itemRequest = $conn->query("SELECT * FROM borrow_requests WHERE id = $requestId")->fetch(PDO::FETCH_ASSOC);

        // Add quantity_bought back to inventory
		$propertyNumber = $itemRequest['property_number']; // Get the property number
		$returnedQuantity = $itemRequest['quantity']; // Get the quantity returned

		$updateStmt = $conn->prepare("UPDATE inventory SET quantity_bought = quantity_bought + ? WHERE property_number = ?");
		$updateStmt->execute([$returnedQuantity, $propertyNumber]);

        // Update date_returned in borrow_requests table
		$currentDate = date("Y-m-d");
		$updateReturnedStmt = $conn->prepare("UPDATE borrow_requests SET date_returned = ? WHERE id = ?");
		$updateReturnedStmt->execute([$currentDate, $requestId]);

		// Disable the button by setting the session variable
		$_SESSION['returned_' . $requestId] = true;

		// Update the request data to reflect the new date_returned value
		$request['date_returned'] = $currentDate;


    }
	    elseif (isset($_POST['delete'])) {
        $requestId = $_POST['request_id'];

        // Delete the request from the database
        $deleteStmt = $conn->prepare("DELETE FROM borrow_requests WHERE id = ?");
        $deleteStmt->execute([$requestId]);
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>View Item Requests</title>
    <!-- Add your CSS stylesheets here if needed -->
    <style>
    /* Your CSS styles */
    /* ... */
    table {
        width: 100%;
        border-collapse: collapse;
        padding-left: 220px; /* Adjust this value to create space for the search form */
    }
    th, td {
        padding: 8px;
        text-align: center;
        border: 1px solid #ddd;
    }
    th {
        background-color: #4CAF50;
        color: white;
    }
    tr:hover {
        background-color: #f5f5f5;
    }
    </style>
</head>
<body>
    <?php include_once "main_menu.php"; ?>
    <h2 align = "center">View Item Requests</h2>
    <table>
        <thead>
            <tr>
                <th>Request ID</th>
                <th>Item Requested</th>
				<th>Brand</th>
                <th>Model</th>
                <th>Property Number</th>
                <th>Quantity</th>
                <th>Purpose</th>
                <th>Date Needed</th>
                <th>Date Borrowed</th>
                <th>Date Returned</th>
                <th>Requesting Person</th>
                <th>Confirm</th>
                <th>Edit</th>
                <th>Returned</th>
				<th>Delete</th>
            </tr>
        </thead>
        <tbody>
    <?php foreach ($itemRequests as $request) : ?>
        <tr>
            <td><?php echo $request['id']; ?></td>
            <td><?php echo $request['item_request']; ?></td>
            <td><?php echo $request['manufacturer_name']; ?></td>
			<td><?php echo $request['model_number']; ?></td>
            <td><?php echo $request['property_number']; ?></td>
            <td><?php echo $request['quantity']; ?></td>
            <td><?php echo $request['purpose']; ?></td>
            <td><?php echo $request['date_needed']; ?></td>
            <td><?php echo $request['date_borrowed']; ?></td>
            <td><?php echo $request['date_returned']; ?></td>
            <td><?php echo $request['requesting_person']; ?></td>
            <td>
                <?php
                $itemQuantity = $conn->query("SELECT quantity_bought FROM inventory WHERE property_number = '{$request['property_number']}'")->fetchColumn();
                if ($itemQuantity > 0) {
                    if (!$request['date_borrowed']) {
                        echo '<form action="" method="post">';
                        echo '<input type="hidden" name="request_id" value="' . $request['id'] . '">';
                        if ($itemQuantity >= $request['quantity']) {
							echo '<button type="submit" name="confirm">Confirm</button>';
						} else {
							echo '<button type="button" disabled>Confirm</button>';
							echo '<p class="error-message">Insufficient quantity available for borrowing.</p>';
						}

						echo '</form>';
                    } elseif (!$request['date_returned']) {
                        echo '<form action="" method="post">';
                        echo '<input type="hidden" name="request_id" value="' . $request['id'] . '">';
                        echo '<button type="submit" name="returned">Returned</button>';
                        echo '</form>';
                    } else {
                        echo 'This has been returned';
                    }
                } else {
                    echo "Item All Deployed";
                }
                ?>
            </td>
				<td>
					<?php if (!$request['date_returned']) : ?>
						<form action="edit_request.php" method="get">
							<input type="hidden" name="request_id" value="<?php echo $request['id']; ?>">
							<button type="submit" name="edit">Edit</button>
						</form>
					<?php endif; ?>
				</td>
				<td>
					<?php if ($request['date_borrowed']) : ?>
						<form action="" method="post">
							<input type="hidden" name="request_id" value="<?php echo $request['id']; ?>">
							<button type="submit" name="returned" <?php if (isset($_SESSION['returned_' . $request['id']])) echo 'disabled'; ?>>Returned</button>
						</form>
						<?php
						// Disable the button if it's clicked once
						if (isset($_POST['returned'])) {
							$_SESSION['returned_' . $request['id']] = true;
						}
						?>
					<?php elseif ($request['date_returned'] && $request['date_returned'] !== '0000-00-00') : ?>
						<?php echo $request['date_returned']; ?>
					<?php endif; ?>
				</td>
				<td>
                <?php if (!$request['date_borrowed'] || $request['date_returned'] == '0000-00-00') : ?>
                    <form action="" method="post">
                        <input type="hidden" name="request_id" value="<?php echo $request['id']; ?>">
                        <button type="submit" name="delete" onclick="return confirm('Are you sure you want to delete this request?')">Delete</button>
                    </form>
                <?php endif; ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
    </table>
</body>
</html>