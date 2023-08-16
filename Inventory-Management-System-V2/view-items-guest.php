<?php
// Include the database connection file
include_once "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $query = "SELECT * FROM inventory WHERE 1"; // 1 is always true, acts as a base query
    
    $params = array();
    
    if (!empty($_POST['item_name'])) {
        $query .= " AND item_name LIKE ?";
        $params[] = "%" . $_POST['item_name'] . "%";
    }
    
    if (!empty($_POST['ordered_by'])) {
        $query .= " AND ordered_by LIKE ?";
        $params[] = "%" . $_POST['ordered_by'] . "%";
    }
    
    if (!empty($_POST['property_number'])) {
        $query .= " AND property_number LIKE ?";
        $params[] = "%" . $_POST['property_number'] . "%";
    }
	
	if (!empty($_POST['designation'])) {
        $query .= " AND designation LIKE ?";
        $params[] = "%" . $_POST['designation'] . "%";
    }
	
	if (!empty($_POST['model_number'])) {
        $query .= " AND model_number LIKE ?";
        $params[] = "%" . $_POST['model_number'] . "%";
    }
	
	if (!empty($_POST['requesting_person'])) {
        $query .= " AND requesting_person LIKE ?";
        $params[] = "%" . $_POST['requesting_person'] . "%";
    }
	
	if (!empty($_POST['manufacturer_name'])) {
        $query .= " AND manufacturer_name LIKE ?";
        $params[] = "%" . $_POST['manufacturer_name'] . "%";
    }
	
	if (!empty($_POST['received_by'])) {
        $query .= " AND received_by LIKE ?";
        $params[] = "%" . $_POST['received_by'] . "%";
    }
	
	if (!empty($_POST['description'])) {
        $query .= " AND description LIKE ?";
        $params[] = "%" . $_POST['description'] . "%";
    }
    
    
    // Add more conditions for other columns
    
    $stmt = $conn->prepare($query);
    $stmt->execute($params);
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Fetch all items from the inventory table
    $stmt = $conn->query("SELECT * FROM inventory ORDER BY purchase_date DESC");
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Check if the delete form is submitted
if (isset($_POST['delete_item'])) {
    $itemID = $_POST['item_id'];
    deleteItem($conn, $itemID);
    // Redirect to the same page to refresh the list after deletion
    header("Location: view-items-guest.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Items</title>
    <!-- Add your CSS stylesheets here if needed -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

		th {
		  background-color: #4CAF50;
		  color: white;
		  padding: 8px;
		  text-align: center;
		  font-weight: bold;
		  text-transform: uppercase;
		}
		th:first-child {
		  border-top-left-radius: 8px;
		}
		th:last-child {
		  border-top-right-radius: 8px;
		}
		
		td {
		  padding: 8px;
		  text-align: center;
		  border: 1px solid #ddd;
		}

        tr:hover {
            background-color: #f5f5f5;
        }

        form {
            text-align: center;
            margin-bottom: 20px;
        }

        input[type="text"] {
            padding: 8px;
            width: 200px;
        }

        input[type="submit"] {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .edit-button,
        .green-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }
		
	.center {
      text-align: center;
    }
    .add-button {
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
	.search-container {
		display: flex;
		flex-direction: column;
		align-items: flex-start;
	}

	.search-field {
		width: 100%;
		margin-bottom: 10px; /* Add spacing between search fields */
	}

	.search-field label {
		display: block;
		margin-bottom: 5px;
	}

	.search-field input {
		width: 100%;
		padding: 5px;
		border: 1px solid #ccc;
		border-radius: 3px;
	}
    </style>
</head>
<body>
    <h2>List of Items</h2>
	<form action="view-items-guest.php" method="post">
		<div class="search-container">
			<label for="item_name">Item Name:</label>
			<input type="text" name="item_name" placeholder="Search by item name..."> <br>
			
			<label for="ordered_by">Requesting Department:</label>
			<input type="text" name="ordered_by" placeholder="Search by Requesting Department..."> <br>
			
			<label for="property_number">Property Number:</label>
			<input type="text" name="property_number" placeholder="Search by property number..."> <br>

			<label for="designation">Status:</label>
			<input type="text" name="designation" placeholder="Search by designation..."> <br>

			<label for="model_number">Model:</label>
			<input type="text" name="model_number" placeholder="Search by model..."> <br>
			
			<label for="requesting_person">Requesting Person:</label>
			<input type="text" name="requesting_person" placeholder="Search by Requesting Person..."> <br>
			
			<label for="manufacturer_name">Brand:</label>
			<input type="text" name="manufacturer_name" placeholder="Search by Brand..."><br>
			
			<label for="received_by">Receiving Person:</label>
			<input type="text" name="received_by" placeholder="Search by Receiving Person..."> <br>
			
			<label for="description">Description:</label>
			<input type="text" name="description" placeholder="Search by Description..."> <br>

			<input type="submit" name="search" value="Search">
		</div>
	</form>
     <table>
        <thead>
            <tr>
                <th>Item ID</th>
                <th>Item Name</th>
                <th>Requesting Department</th>
				<th>Requesting Person</th>
                <th>Received By</th>
				<th>Assigned Office</th>
                <th>Property Number</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Serial Number</th>
                <th>Supplier's Name</th>
				<th>Ordered By</th>
                <th>OR Number</th>
                <th>Delivery Date</th>
                <th>Purchase Date</th>
				<th>Issuance Date</th>
                <th>Description</th>
				<th>Remarks</th>
                <th>Status</th>
                <th>Transfer History</th>
				<th>Receipt Link</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item) : ?>
                <tr>
                    <td><?php echo $item['id']; ?></td>
                    <td><?php echo $item['item_name']; ?></td>
                    <td><?php echo $item['ordered_by']; ?></td>
					<td><?php echo $item['requesting_person']; ?></td>
                    <td><?php echo $item['received_by']; ?></td>
					<td><?php echo $item['assigned_office']; ?></td>
                    <td><?php echo $item['property_number']; ?></td>
                    <td><?php echo $item['quantity_bought']; ?></td>
                    <td><?php echo $item['amount']; ?></td>
                    <td><?php echo $item['manufacturer_name']; ?></td>
                    <td><?php echo $item['model_number']; ?></td>
                    <td><?php echo $item['serial_number']; ?></td>
                    <td><?php echo $item['supplier_name']; ?></td>
					<td><?php echo $item['ordering_person']; ?></td>
                    <td><?php echo $item['OR_number']; ?></td>
                    <td><?php echo $item['delivery_date']; ?></td>
                    <td><?php echo $item['purchase_date']; ?></td>
					<td><?php echo $item['issuance_date']; ?></td>
                    <td><?php echo $item['description']; ?></td>
					<td><?php echo $item['remarks']; ?></td>
                    <td><?php echo $item['designation']; ?></td>
                    <td><?php echo $item['transfer_history']; ?></td>
					<td><?php echo $item['receipt_link']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<br>
	<div class="center">
		<a href="login.php" class="add-button">Logout</a> <br> <br>
		<a href="item-request.php" class="add-button">Request/Borrow Items</a>
	</div>
</body>
</html>
