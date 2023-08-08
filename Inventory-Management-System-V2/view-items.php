<?php
// Include the database connection file
include_once "db_connect.php";

// Check if the search form is submitted
if (isset($_POST['search'])) {
    $searchQuery = $_POST['searchQuery'];

    // Fetch items from the database based on the search query
    $stmt = $conn->prepare("SELECT * FROM inventory WHERE 
	item_name LIKE ? 
	OR ordered_by LIKE ? 
	OR property_number LIKE ? 
	OR designation LIKE ? 
	OR manufacturer_name LIKE ?
	OR model_number LIKE ?
	OR requesting_person LIKE ?
	OR received_by LIKE ?
	OR supplier_name LIKE ?
	OR description LIKE ?
	OR serial_number LIKE ?
	OR YEAR(purchase_date) = ?");
    $stmt->execute(["%$searchQuery%", 
	"%$searchQuery%", 
	"%$searchQuery%", 
	"%$searchQuery%", 
	"%$searchQuery%", 
	"%$searchQuery%", 
	"%$searchQuery%", 
	"%$searchQuery%", 
	"%$searchQuery%",
	"%$searchQuery%",	
	"%$searchQuery%", $searchQuery]);
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Fetch all items from the inventory table
    $stmt = $conn->query("SELECT * FROM inventory");
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
    </style>
</head>
<body>
	<?php include_once "main_menu.php"; ?>
    <h2>List of Items</h2>
    <form action="view-items.php" method="post">
        <input type="text" name="searchQuery" placeholder="Search...">
        <input type="submit" name="search" value="Search">
    </form>
    <table>
        <thead>
            <tr>
                <th>Item ID</th>
                <th>Item Name</th>
                <th>Requesting Department</th>
				<th>Requesting Person</th>
                <th>Person Assigned</th>
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
