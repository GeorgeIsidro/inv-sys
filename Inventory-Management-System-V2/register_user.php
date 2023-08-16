<!-- register_user.php -->
<?php
include_once "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['FName'];
    $lastName = $_POST['LName'];
    $username = $_POST['UName'];
    $password = $_POST['PWord'];
	$userRole = $_POST['user_role'];

    try {
        $stmt = $conn->prepare("INSERT INTO users (FName, LName, UName, PWord, user_role) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$firstName, $lastName, $username, $password, $userRole]);

        echo '<script>
            alert("Registration successful! Please login to continue.");
            window.location.href = "login.php";
            </script>';
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
