<!-- login_user.php -->
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
            // Add other user data to session if needed

            // Redirect the user to the main page after successful login
            header("Location: main_menu.php");
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
