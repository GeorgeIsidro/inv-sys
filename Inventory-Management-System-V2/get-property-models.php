<?php
// Include the database connection file
include_once "db_connect.php";

if (isset($_GET["item"])) {
    $selectedItem = $_GET["item"];

    // Fetch property numbers based on the selected item
    $stmt = $conn->prepare("SELECT property_number FROM inventory WHERE item_name = ?");
    $stmt->execute([$selectedItem]);
    $propertyNumbers = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Return property numbers as JSON response
    header("Content-Type: application/json");
    echo json_encode($propertyNumbers);
}
?>
