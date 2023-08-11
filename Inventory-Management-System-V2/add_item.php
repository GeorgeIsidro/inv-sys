<!DOCTYPE html>
<html>
<head>
  <title>Add Item to Inventory</title>
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
	<?php include_once "main_menu.php"; ?>
  <h2>Add Item to Inventory</h2>
  <form action="insert_item.php" method="post">
    <label for="item_name">Item Name:</label>
    <input type="text" name="item_name" required>

    <label for="ordered_by">Requesting Department:</label>
    <input type="text" name="ordered_by" required>
	
	<label for="requesting_person">Requesting Person:</label>
    <input type="text" name="requesting_person" required>

    <label for="received_by">Received By:</label>
    <input type="text" name="received_by" required>

    <label for="property_number">Property Number:</label>
    <input type="text" name="property_number" required>

    <label for="quantity_bought">Quantity:</label>
    <input type="number" name="quantity_bought" required>

    <label for="amount">Price:</label>
    <input type="number" name="amount" required>

    <label for="manufacturer_name">Brand:</label>
    <input type="text" name="manufacturer_name" required>
	
	<label for="model_number">Model:</label>
    <input type="text" name="model_number" required>

    <label for="serial_number">Serial Number:</label>
    <input type="text" name="serial_number" required>
	
	<label for="ordering_person">Ordered By:</label>
    <input type="text" name="ordering_person" required>

    <label for="supplier_name">Supplier's Name:</label>
    <input type="text" name="supplier_name" required>

    <label for="or_number">OR Number:</label>
    <input type="text" name="or_number" required>

    <label for="delivery_date">Delivery Date:</label>
    <input type="date" name="delivery_date" required>

    <label for="purchase_date">Purchase Date:</label>
    <input type="date" name="purchase_date" required>
	
	<label for="issuance_date">Issuance Date:</label>
    <input type="date" name="issuance_date" required>

    <label for="description">Description:</label>
    <input type="text" name="description" required>

    <label for="designation">Status:</label>
    <select id="designation" name="designation">
      <option value="">Select a status</option>
      <option value="For Repair">For Repair</option>
      <option value="Repaired">Repaired</option>
      <option value="Assigned">Assigned</option>
      <option value="For Disposal">For Disposal</option>
      <option value="Disposed">Disposed</option>
	  <option value="Borrowed">Borrowed</option>
	  <option value="Available">Available</option>
      <option value="New">New</option>
    </select>

    <label for="transfer_history">History of Transfer:</label>
    <input type="text" class="form-control" id="transfer_history" name="transfer_history">
	
    <label for="receipt_link">Link For Receipt:</label>
    <input type="text" name="receipt_link" required>
	
	<label for="assigned_office">Assigned Office:</label>
    <input type="text" class="form-control" id="assigned_office" name="assigned_office">
	
	<label for="remarks">Remarks:</label>
    <input type="text" class="form-control" id="remarks" name="remarks">

    <input type="submit" value="Add Item"><br>
	<a href="view-items.php" class="button">View Inventory</a>

  </form>
  <br>
</body>
</html>
