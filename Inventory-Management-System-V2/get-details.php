<?php
include_once "db_connect.php";

if (isset($_GET["item"])) {
    $selectedItem = $_GET["item"];

    $stmt = $conn->prepare("SELECT manufacturer_name, model_number, property_number FROM inventory WHERE item_name = ?");
    $stmt->execute([$selectedItem]);
    $details = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Extract model numbers and property numbers into separate arrays
    $modelNumbers = array_column($details, 'model_number');
    $propertyNumbers = array_column($details, 'property_number');
	$manufacturerName = array_column($details, 'manufacturer_name');

    // Create an associative array with both arrays
    $response = [
        'model_numbers' => $modelNumbers,
        'property_numbers' => $propertyNumbers,
		'manufacturer_name' => $manufacturerName
    ];

    header("Content-Type: application/json");
    echo json_encode($response);
}
?>
