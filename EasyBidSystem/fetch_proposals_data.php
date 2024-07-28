<?php
session_start();
$user_id = $_SESSION['user_id']; // Ensure user_id is set in the session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "easybid_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user proposals data
$proposals_sql = "SELECT quarter, proposals FROM user_proposals WHERE user_id = ?";
$stmt = $conn->prepare($proposals_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$proposals_result = $stmt->get_result();
$proposals_data = [];
while ($row = $proposals_result->fetch_assoc()) {
    $proposals_data[] = $row;
}

$stmt->close();
$conn->close();

echo json_encode(['proposals' => $proposals_data]);
?>
