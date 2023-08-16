<?php
// Include the database connection file
include_once "db_connect.php";

// Get the request ID from the URL parameter
if (isset($_GET['request_id'])) {
    $requestId = $_GET['request_id'];
    
    // Fetch the request details from the database
    $request = $conn->query("SELECT * FROM borrow_requests WHERE id = $requestId")->fetch(PDO::FETCH_ASSOC);
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Update date_borrowed and date_returned in borrow_requests table
        $dateBorrowed = $_POST['date_borrowed'];
        $dateReturned = $_POST['date_returned'];

        $updateStmt = $conn->prepare("UPDATE borrow_requests SET date_borrowed = ?, date_returned = ? WHERE id = ?");
        $updateStmt->execute([$dateBorrowed, $dateReturned, $requestId]);

        // Redirect back to the view-requests.php page after updating
        header("Location: view-requests.php");
        exit();
    }
} else {
    // Redirect to view-requests.php if request ID is not provided
    header("Location: view-requests.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Request</title>
    <!-- Add your CSS stylesheets here if needed -->
</head>
<body>
    <?php include_once "main_menu.php"; ?>
    <h2 align="center">Edit Request</h2>
    
    <form action="" method="post">
        <label for="date_borrowed">Date Borrowed:</label>
        <input type="date" name="date_borrowed" value="<?php echo $request['date_borrowed']; ?>" required>
        
        <label for="date_returned">Date Returned:</label>
        <input type="date" name="date_returned" value="<?php echo $request['date_returned']; ?>">
        
        <button type="submit">Save</button>
    </form>
</body>
</html>
