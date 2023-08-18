<?php
include_once "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    $orNumber = $_POST['or_number'];
    $amount = $_POST['amount'];
    $transferHistory = $_POST['transfer_history'];
    $orderedBy = $_POST['ordered_by'];
	$requestingPerson = $_POST['requesting_person'];
	$orderingPerson = $_POST['ordering_person'];
	$receiptLink = $_POST['receipt_link'];
	$issuanceDate = $_POST['issuance_date'];
	$assignedOffice = $_POST['assigned_office'];
	$remarks = $_POST['remarks'];

    // Check if the property number already exists in the database
    $stmt = $conn->prepare("SELECT COUNT(*) FROM inventory WHERE property_number = ?");
    $stmt->execute([$propertyNumber]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        echo '<script>
            alert("Property number already exists. Please enter a unique property number.");
            window.location.href = "add_item.php";
            </script>';
    } else {
        $quantityAssigned = $_POST['quantity_assigned'];

        // Deduct the assigned quantity from the bought quantity
        $remainingQuantity = $quantityBought - $quantityAssigned;

        if ($remainingQuantity >= 0) {
            // Update the quantity_bought and quantity_assigned in the database
            $updateStmt = $conn->prepare("UPDATE inventory SET quantity_bought = ?, quantity_assigned = ?, quantity_remaining = ? WHERE item_name = ?");
            $updateStmt->execute([$quantityBought, $quantityAssigned, $remainingQuantity, $itemName]);

            try {
                $stmt = $conn->prepare("INSERT INTO inventory (
                item_name,
                purchase_date,
                delivery_date,
                property_number,
                serial_number, 
				model_number, 
				description, 
				manufacturer_name, 
				quantity_bought,
				quantity_assigned,
				quantity_remaining,
				designation, 
				received_by, 
				supplier_name, 
				OR_number, 
				amount, 
				transfer_history, 
				ordered_by, 
				requesting_person,
				ordering_person,
				receipt_link,
				issuance_date,
				assigned_office,
				remarks
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$itemName,
                $purchaseDate,
                $deliveryDate,
                $propertyNumber,
                $serialNumber, 
				$modelNumber, 
				$description, 
				$manufacturerName, 
				$quantityBought, 
				$quantityAssigned,
				$remainingQuantity,
				$designation, 
				$receivedBy, 
				$supplierName, 
				$orNumber, 
				$amount, 
				$transferHistory, 
				$orderedBy, 
				$requestingPerson, 
				$orderingPerson, 
				$receiptLink, 
				$issuanceDate, 
				$assignedOffice, 
                $remarks]);

                echo '<script>
                    alert("Item added successfully!");
                    window.location.href = "view-items.php";
                    </script>';
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            // Display an error message
            $errorMsg = "Quantity assigned cannot exceed quantity bought.";
        }
    }
}
?>
