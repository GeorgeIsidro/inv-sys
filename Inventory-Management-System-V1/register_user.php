<!-- register_user.php -->
<?php
include_once "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $stmt = $conn->prepare("INSERT INTO users (FName, LName, UName, PWord) VALUES (?, ?, ?, ?)");
        $stmt->execute([$firstName, $lastName, $username, $password]);

        echo '<script>
            alert("Registration successful! Please login to continue.");
            window.location.href = "login.php";
            </script>';
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
