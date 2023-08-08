<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "database_inv"; // Replace with your database name

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  exit;
}

function deleteItem($conn, $itemID) {
    // Prepare and execute the DELETE statement to delete the item with the specified itemID
    $stmt = $conn->prepare("DELETE FROM inventory WHERE id = ?");
    $stmt->execute([$itemID]);
}
?>
