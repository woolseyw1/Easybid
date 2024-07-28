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

// Fetch user revenue data
$revenue_sql = "SELECT date, revenue FROM user_revenue WHERE user_id = ?";
$stmt = $conn->prepare($revenue_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$revenue_result = $stmt->get_result();
$revenue_data = [];
while ($row = $revenue_result->fetch_assoc()) {
    // Format the date to "Month Day"
    $date = date("F j", strtotime($row['date']));
    $revenue_data[] = ['date' => $date, 'revenue' => $row['revenue']];
}

$stmt->close();
$conn->close();

echo json_encode(['revenue' => $revenue_data]);
?>
