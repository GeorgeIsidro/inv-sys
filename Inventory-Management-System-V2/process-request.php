<?php
include_once "db_connect.php";

$notification = "";
$errorMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemToRequest = $_POST['item_request'];
    $modelNumber = $_POST['model_number'];
    $propertyNumber = $_POST['property_number'];
    $quantity = $_POST['quantity'];
    $purpose = $_POST['purpose'];
    $dateNeeded = $_POST['date_needed'];
    $requestingPerson = $_POST['requesting_person'];

    // Validate the required fields
    if (!empty($itemToRequest) && !empty($modelNumber) && !empty($propertyNumber) && !empty($quantity) && !empty($purpose) && !empty($dateNeeded)) {
        $stmt = $conn->prepare("INSERT INTO borrow_requests (item_request, model_number, property_number, quantity, purpose, date_needed, requesting_person) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$itemToRequest, $modelNumber, $propertyNumber, $quantity, $purpose, $dateNeeded, $requestingPerson]);

        // Display a success notification
        $notification = "Item request sent successfully!";
    } else {
        // Display an error message
        $errorMsg = "Please fill in all the required fields.";
    }
}
?>