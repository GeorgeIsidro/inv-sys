<?php
// Include the database connection file
include_once "db_connect.php";

// Check if the form is submitted with the updated item details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the item ID from the hidden input field
    $itemId = $_POST['item_id'];

    // Get the updated item details from the form
    $itemName = $_POST['item_name'];
    $purchaseDate = $_POST['purchase_date'];
    $deliveryDate = $_POST['delivery_date'];
    $propertyNumber = $_POST['property_number'];
    $serialNumber = $_POST['serial_number'];
    $modelNumber = $_POST['model_number'];
    $description = $_POST['description'];
    $manufacturerName = $_POST['manufacturer_name'];
    $quantityBought = $_POST['quantity_bought'];
    $designation = $_POST['designation'];
    $receivedBy = $_POST['received_by'];
    $supplierName = $_POST['supplier_name'];
    $ORNumber = $_POST['OR_number'];
    $amount = $_POST['amount'];
    $transferHistory = $_POST['transfer_history'];
    $orderedBy = $_POST['ordered_by'];

    // Update the item details in the database
    $stmt = $conn->prepare("UPDATE inventory SET 
                            item_name = ?, 
                            purchase_date = ?, 
                            delivery_date = ?,
                            property_number = ?,
                            serial_number = ?,
                            model_number = ?,
                            description = ?,
                            manufacturer_name = ?,
                            quantity_bought = ?,
                            designation = ?,
                            received_by = ?,
                            supplier_name = ?,
                            OR_number = ?,
                            amount = ?,
                            transfer_history = ?,
                            ordered_by = ?
                            WHERE id = ?");
    $stmt->execute([$itemName, $purchaseDate, $deliveryDate, $propertyNumber, $serialNumber, $modelNumber, $description, $manufacturerName, $quantityBought, $designation, $receivedBy, $supplierName, $ORNumber, $amount, $transferHistory, $orderedBy, $itemId]);

    // Redirect back to the view_items page after the update
    header("Location: view-items.php");
    exit;
} else {
    // If the form is not submitted properly, redirect back to the view_items page
    header("Location: view-items.php");
    exit;
}
