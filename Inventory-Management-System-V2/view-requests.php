<?php
// Include the database connection file
include_once "db_connect.php";

// Fetch all item requests from the database
$stmt = $conn->query("SELECT * FROM borrow_requests ORDER BY date_needed DESC");
$itemRequests = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Item Requests</title>
    <!-- Add your CSS stylesheets here if needed -->
    <style>
    /* Your CSS styles */
    /* ... */
    table {
        width: 100%;
        border-collapse: collapse;
        padding-left: 220px; /* Adjust this value to create space for the search form */
    }
    th, td {
        padding: 8px;
        text-align: center;
        border: 1px solid #ddd;
    }
    th {
        background-color: #4CAF50;
        color: white;
    }
    tr:hover {
        background-color: #f5f5f5;
    }
    </style>
</head>
<body>
    <?php include_once "main_menu.php"; ?>
    <h2 align = "center">View Item Requests</h2>
    <table>
        <thead>
            <tr>
                <th>Request ID</th>
                <th>Item Requested</th>
                <th>Quantity</th>
                <th>Purpose</th>
                <th>Date Needed</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($itemRequests as $request) : ?>
                <tr>
                    <td><?php echo $request['id']; ?></td>
                    <td><?php echo $request['item_request']; ?></td>
                    <td><?php echo $request['quantity']; ?></td>
                    <td><?php echo $request['purpose']; ?></td>
                    <td><?php echo $request['date_needed']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
