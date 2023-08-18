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
	
	if (!empty($_POST['supplier_name'])) {
        $query .= " AND supplier_name LIKE ?";
        $params[] = "%" . $_POST['supplier_name'] . "%";
    }
	
	if (!empty($_POST['description'])) {
        $query .= " AND description LIKE ?";
        $params[] = "%" . $_POST['description'] . "%";
    }
	
	if (!empty($_POST['serial_number'])) {
        $query .= " AND serial_number LIKE ?";
        $params[] = "%" . $_POST['serial_number'] . "%";
    }
	
	if (!empty($_POST['ordering_person'])) {
        $query .= " AND ordering_person LIKE ?";
        $params[] = "%" . $_POST['ordering_person'] . "%";
    }
	
	if (!empty($_POST['transfer_history'])) {
        $query .= " AND transfer_history LIKE ?";
        $params[] = "%" . $_POST['transfer_history'] . "%";
    }
	
    if (!empty($_POST['year_purchase'])) {
        $query .= " AND YEAR(purchase_date) = ?";
        $params[] = $_POST['year_purchase'];
    }
	
	if (!empty($_POST['remarks'])) {
        $query .= " AND remarks LIKE ?";
        $params[] = $_POST['remarks'];
    }
	
		if (!empty($_POST['assigned_office'])) {
        $query .= " AND assigned_office LIKE ?";
        $params[] = $_POST['assigned_office'];
    }
	
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
    header("Location: view-items.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Items</title>
    <!-- Add your CSS stylesheets here if needed -->
    <style>
    .navbar {
        background-color: #333;
        overflow: hidden;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%; /* Make the navbar span the entire width */
        z-index: 100; /* Set a higher z-index for the navbar */
    }

	.body {
		font-family: Arial, sans-serif;
		margin: 0;
		padding-top: 70px; /* Adjust this value to match the header's height */
	}

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

	table {
		width: 100%;
		border-collapse: collapse;
		margin-top: 20px; /* Add margin to the top to create space below the fixed header */
	}

    th {
        background-color: #4CAF50;
        color: white;
        padding: 8px;
        text-align: center;
        font-weight: bold;
        text-transform: uppercase;
        position: relative;
        z-index: 1001; /* Set an even higher z-index */
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
	table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 50px; /* Add margin to the top to create space for the fixed search form */
	}
	
	.search-container {
		display: flex;
		flex-direction: column;
		align-items: flex-start;
		margin-left: 10px;
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
	<?php include_once "main_menu.php"; ?>
    <h2>List of Items</h2>
	<form action="view-items.php" method="post">
		<div class="search-container">
			<div class = "search-container">
			<label for="item_name">Item Name: </label>
			<input type="text" name="item_name" placeholder="Search by item name..."> <br>
			</div>
			
			<div class = "search-container">
			<label for="ordered_by">Requesting Sector: </label>
			<input type="text" name="ordered_by" placeholder="Search by Requesting Sector..."> <br>
			</div>
			
			<div class = "search-container">
			<label for="property_number">Property Number: </label>
			<input type="text" name="property_number" placeholder="Search by property number..."> <br>
			</div>
			
			<div class="search-container">
			<label for="designation">Status:</label>
			<input type="text" name="designation" placeholder="Search by designation..."> <br>
			</div>
			
			<div class="search-container">
			<label for="model_number">Model:</label>
			<input type="text" name="model_number" placeholder="Search by model..."> <br>
			</div>
			
			<div class="search-container">
			<label for="requesting_person">Requesting Person:</label>
			<input type="text" name="requesting_person" placeholder="Search by Requesting Person..."> <br>
			</div>
			
			<div class="search-container">
			<label for="manufacturer_name">Brand:</label>
			<input type="text" name="manufacturer_name" placeholder="Search by Brand..."><br>
			</div>
			
			<div class="search-container">
			<label for="received_by">Receiving Person:</label>
			<input type="text" name="received_by" placeholder="Search by Receiving Person..."> <br>
			</div>
			
			<div class="search-container">
			<label for="supplier_name">Supplier's Name:</label>
			<input type="text" name="supplier_name" placeholder="Search by Supplier..."> <br>
			</div>
			
			<div class="search-container">
			<label for="description">Description:</label>
			<input type="text" name="description" placeholder="Search by Description..."> <br>
			</div>
			
			<div class="search-container">
			<label for="serial_number">Serial Number:</label>
			<input type="text" name="serial_number" placeholder="Search by Serial Number..."> <br>
			</div>
			
			<div class="search-container">
			<label for="ordering_person">Ordering Person:</label>
			<input type="text" name="ordering_person" placeholder="Search by Ordering Person..."> <br>
			</div>
			
			<div class="search-container">
			<label for="transfer_history">Transfer History:</label>
			<input type="text" name="transfer_history" placeholder="Search by Transfer History..."> <br>
			</div>
			
			<div class="search-container">
			<label for="year_purchase">Purchase Year:</label>
			<input type="text" name="year_purchase" placeholder="Search by purchase year..."> <br> 
			</div>
			
			<div class="search-container">
			<label for="remarks">Remarks:</label>
			<input type="text" name="remarks" placeholder="Search by Remarks..."> <br> <br>
			</div>
			
			<div class="search-container">
			<label for="assigned_office">Assigned Office:</label>
			<input type="text" name="assigned_office" placeholder="Search by Assigned Office..."> <br> <br>
			</div>
			
			<input type="submit" name="search" value="Search">
		</div>
	</form>
    <table>
        <thead>
            <tr>
                <th>Item ID</th>
                <th>Item Name</th>
                <th>Requesting Sector</th>
				<th>Requesting Person</th>
                <th>Received By</th>
				<th>Assigned Office</th>
                <th>Property Number</th>
                <th>Quantity Bought</th>
				<th>Quantity Assigned</th>
				<th>Quantity Remaining</th>
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
                <th>Action</th>
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
					<td><?php echo $item['quantity_assigned']; ?></td>
					<td><?php echo $item['quantity_remaining']; ?></td>
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
                    <td>
							<!-- Add the Edit button -->
						<form action="edit-items.php" method="get" style="display: inline-block;">
							<!-- Hidden field to store the item ID -->
							<input type="hidden" name="id" value="<?php echo $item['id']; ?>">
							<!-- Add the Edit button with the green style -->
							<button type="submit" class="green-button">Edit</button>
						</form>


                        <!-- Add the Delete button -->
                        <form action="view-items.php" method="post" style="display: inline-block;">
                            <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                            <input type="submit" name="delete_item" value="Delete" onclick="return confirm('Are you sure you want to delete this item?')">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<br>
	<div class="center">
	  <a href="add_item.php" class="add-button">Add Item</a>
	</div>
</body>
</html>
