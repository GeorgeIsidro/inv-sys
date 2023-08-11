<?php
session_start();
include_once "db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE UName = ? AND PWord = ?");
        $stmt->execute([$username, $password]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // User found, store user data in session variables for future reference
            $_SESSION['user_id'] = $user['UserID'];
            $_SESSION['first_name'] = $user['FName'];
            $_SESSION['last_name'] = $user['LName'];
            $_SESSION['user_role'] = $user['user_role']; // Add user role to session

            // Redirect the user based on user_role
            if ($user['user_role'] == 'administrator') {
                header("Location: view-items.php"); // Redirect admin to view-items.php
            } else {
                header("Location: view-items-guest.php"); // Redirect other roles to view-items-guest.php
            }
            exit();
        } else {
            // User not found or incorrect credentials, display an error message
            echo '<script>
                alert("Invalid username or password. Please try again.");
                window.location.href = "login.php";
                </script>';
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
