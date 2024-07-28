<?php
// update_status.php

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "easybid_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get RFP ID from POST request
$id = intval($_POST['id']);

// Update RFP status to closed
$sql = "UPDATE rfps SET status = 'Closed' WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$stmt->close();
$conn->close();
?>
