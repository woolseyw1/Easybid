<?php
// update_profile.php

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "easybid_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start session and fetch user ID
session_start();
$user_id = $_SESSION['user_id'];

// Collect user inputs
$new_username = $_POST['username'] ?? null;
$new_email = $_POST['email'] ?? null;
$new_phone = $_POST['phone'] ?? null;
$new_address = $_POST['address'] ?? null;
$new_password = $_POST['password'] ?? null;
$confirm_password = $_POST['confirmPassword'] ?? null;

// Fetch current user details
$sql = "SELECT password FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($current_password);
$stmt->fetch();
$stmt->close();

// Basic validation
if ($new_password && $new_password !== $confirm_password) {
    die("Passwords do not match.");
}

// Hash new password if provided
$hashed_password = $new_password ? password_hash($new_password, PASSWORD_DEFAULT) : $current_password;

// Update user information
$sql = "UPDATE users SET username = COALESCE(?, username), email = COALESCE(?, email), phone = COALESCE(?, phone), address = COALESCE(?, address), password = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssi", $new_username, $new_email, $new_phone, $new_address, $hashed_password, $user_id);

if ($stmt->execute()) {
    echo "Profile updated successfully.";
} else {
    echo "Error updating profile: " . $stmt->error;
}

$stmt->close();
$conn->close();

// Redirect back to profile page
header("Location: profile.php");
exit();
?>
