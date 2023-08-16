<?php
// Include the database connection file
include_once "db_connect.php";

if (isset($_GET["item"])) {
    $selectedItem = $_GET["item"];

    // Fetch model numbers based on the selected item
    $stmt = $conn->prepare("SELECT model_number FROM inventory WHERE item_name = ?");
    $stmt->execute([$selectedItem]);
    $models = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Return model numbers as JSON response
    header("Content-Type: application/json");
    echo json_encode($models);
}
?>
