//register.php

<?php
include 'db_config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['new_fname'];
    $last_name = $_POST['new_lname'];
    $username = $_POST['new_uname'];
    $email = $_POST['new_email'];
    $phone = $_POST['new_phone'];
    $state = $_POST['state'];
    $business_license = $_POST['new_license'];
    $city = $_POST['new_city'];
    $address = $_POST['new_address'];
    $password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (first_name, last_name, username, email, phone, state, business_license, city, address, password) 
            VALUES ('$first_name', '$last_name', '$username', '$email', '$phone', '$state', '$business_license', '$city', '$address', '$password')";

    if ($conn->query($sql) === TRUE) {
        $user_id = $conn->insert_id;
        $_SESSION['user_id'] = $user_id;
        echo "New record created successfully";
        header("Location: reg.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
