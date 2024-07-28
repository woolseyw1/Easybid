<?php
// login.php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    echo "Username: $username<br>";
    echo "Password: $password<br>";

    if ($stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?")) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_id, $hashed_password);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                $_SESSION['user_id'] = $user_id; // Store user_id in session
                $_SESSION['username'] = $username;
                header("Location: dashboard.php");
                exit();
            } else {
                echo "<script>alert('Invalid username or password'); window.location.href='reg.html';</script>";
            }
        } else {
            echo "<script>alert('Invalid username or password'); window.location.href='reg.html';</script>";
        }

        $stmt->close();
    } else {
        echo "Error preparing SQL statement: " . $conn->error;
    }

    $conn->close();
}
?>
